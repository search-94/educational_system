<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class CoordinatorScoreController extends BaseController {

	public function getShow() {

		$grades = Grade::all();
		return View::make('coordinator.score.show')->with('grades', $grades);
	}

	public function fill_subjects() {

		if (Request::ajax()) {

			$id_grade = Input::get('id_grade');

			try {

		        $subjects = new Subject();
		        $subjects = $subjects->getSubjects($id_grade);
		        if ($subjects != null) {

		        	echo json_encode($subjects);

		        } else {

		        	echo (null);

		        }
		     				
			} catch(ModelNotFoundException $e) {

				echo "error";
			}
		}
	}

	public function download($id_grade, $id_subject) {

		
		$subject = Subject::find($id_subject);
		$grade = Grade::find($id_grade);
		$users = User::where('id_grade', '=', $id_grade)->get();
		$id_teacher = UserSubject::where('id_subject', '=', $id_subject)->first();
		if ($id_teacher != null) {

			$teacher = User::find($id_teacher->id_user);

			if ($users != null) {

				$proposed_homeworks = ProposedHomework::where('id_subject', $id_subject)->get();

				if (!$proposed_homeworks->isEmpty()) {
					
					$period = Period::first();
					$html = '<html>
								<head>
									<meta charset="UTF-8">
								    <style>
										table, th, td {
										    border: 1px solid black;
										    border-collapse: collapse;
										}
										th, td {
										    padding: 5px;
										    text-align: center;
										}
									</style>
								</head>
								  <body>
								  	<center>
								  		Colegio Jesús de Nazaret <br>
								  		Año Escolar '.$period->year.' / '.($period->year + 1) .' <br>
								  		'.$period->lapse.'° Lapso <br>
								  		Asignatura: '.$subject->name.' <br>
								  		Docente: '.$teacher->first_name.' '.$teacher->second_name.' <br> <br>
								  		Reporte de Calificaciones <br>
								  	</center>
								    <table style="width:100%">
								      <thead>
								        <tr>
								          <th>CI</th>
								          <th>Nombre</th>
								          <th>Apellido</th>';

					$count = 0;
					$weighing_count = 0;
					foreach($proposed_homeworks as $proposed_homework) {
						$count++;
						$weighing_count = $weighing_count + $proposed_homework->weighing;
						$html.= '
					
						          <th>Nota '.$count.' ('.$proposed_homework->weighing.'%)</th>';
					}

					$html .= '	<th> Nota total ('.$weighing_count.'%)</th> 
								</tr>
						      </thead>
						      <tbody>';
					$average_score = 0;
			      	$n_students = 0;
					foreach($users as $user) {

						$total_weighing = 0;
						$sum_score	= 0;

						$html.='<tr>
					            <td>'.$user->identity_card.'</td>
					            <td>'.$user->first_name.'</td>
					            <td>'.$user->second_name.'</td>';

						foreach($proposed_homeworks as $proposed_homework) {

							$total_weighing  = $total_weighing + $proposed_homework->weighing;
							$done_homework = DoneHomework::where('id_user', $user->id)->where('id_proposed_homework', $proposed_homework->id)->first();
							if ($done_homework != null) { //if the done homework exists

								$html.= '<td>'.number_format($done_homework->score, 2).'</td>';
								$sum_score = $sum_score + ($done_homework->score * $proposed_homework->weighing);
							} else {

								$html.= '<td> 0.00 </td>';
							}
						}	
						
						$total_score = $sum_score / $total_weighing;
						$average_score = $average_score + $total_score;
						$n_students++;
			            $html.= '<td>'.number_format($total_score, 2).'</td>
					          </tr>';
						
					}

					$average_score = $average_score / $n_students;

					$html.='	</tbody>
						    </table>
						    <br>
						    Promedio general de la asignatura = '.number_format($average_score, 2).' puntos.
						  </body>
						</html>';

						    return PDF::load($html, 'A4', 'landscape')->show("reporte");
				} else {

					Session::flash('message', Lang::get('coordinator.empty_assignments'));
					Session::flash('class', 'danger');

					return Redirect::to('coordinator/score/show');
				}

			} else {

				Session::flash('message', Lang::get('coordinator.empty_students'));
				Session::flash('class', 'danger');

				return Redirect::to('coordinator/score/show');
			}

		} else {

				Session::flash('message', Lang::get('coordinator.empty_teacher'));
				Session::flash('class', 'danger');

				return Redirect::to('coordinator/score/show');
		}


	}

}