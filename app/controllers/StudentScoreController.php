<?php

class StudentScoreController extends BaseController {

	public function getShow() {

		$user = Auth::user();
		$grade = new Grade();
		$grade = $grade->getStudentGrade($user->id_grade);
		$period = new Period();
		$period = $period->getActualPeriod();
		return View::make('student/score/show')->with('user', $user)->with('grade', $grade)->with('period', $period);
	}

	public function download() {

		$user = Auth::user();
		
		$subjects = new Subject();
		$proposed_homeworks = new ProposedHomework();
		$done_homeworks = new doneHomework();
		$period = Period::first();

		$subjects = $subjects->getSubjects($user->id_grade);

		if ($subjects != null) {

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
			  		Grado: '.$user->id_grade.'° año <br> 
			  		Estudiante: '.$user->first_name.' '.$user->second_name.'<br><br>
			  		Reporte de Calificaciones <br>
			  	</center>
			    <table style="width:100%">
			      <thead>
			        <tr>
			          <th>Materia</th>
			          <th>Calificación</th>
			          <th>Ponderación</th>
			        </tr>
			      </thead>
			      <tbody>';

			$empty_proposed_homeworks = true;

			$average_score = 0;
			$n_subjects = 0;
			$average_total_weighing = 0;
			foreach ($subjects as $subject) {

				$total_weighing = 0;
				$sum_score	= 0;

				$subject_proposed_homeworks = $proposed_homeworks->getProposedHomeworks($subject->id);

				if (!$subject_proposed_homeworks->isEmpty()) {

					$empty_proposed_homeworks = false;
					foreach ($subject_proposed_homeworks as $subject_proposed_homework) {
						
						$total_weighing  = $total_weighing + $subject_proposed_homework->weighing;
						$done_homework = $done_homeworks->getDoneHomeworkStudent($subject_proposed_homework->id, $user->id);
						if ($done_homework != null) {

							$sum_score = $sum_score + ($done_homework->score * $subject_proposed_homework->weighing);
						}

					}	
					$total_score = $sum_score / $total_weighing;

					$average_score = $average_score + ($total_score * $total_weighing);
					$average_total_weighing = $average_total_weighing + $total_weighing;

		     		$html.='<tr>
				            <td>'.$subject->name.'</td>
				            <td>'.number_format($total_score, 2).'</td>
				            <td>'.$total_weighing.'%</td>
				          </tr>';		
				}

			}

			if ($average_total_weighing != 0) {

				$average_score = $average_score / $average_total_weighing;

				if ($empty_proposed_homeworks == false) {

					$html.='	</tbody>
						    </table>
						    <br>
						    Promedio general del estudiante = '.number_format($average_score, 2).' puntos.
						  </body>
						</html>';

						    return PDF::load($html, 'A4', 'portrait')->show("reporte");

				} else {

					Session::flash('message', Lang::get('student.score.error'));
					Session::flash('class', 'danger');

					return Redirect::to('student/score/show');
				}
			} else {

				Session::flash('message', Lang::get('student.score.error'));
				Session::flash('class', 'danger');

				return Redirect::to('student/score/show');
			}

		}

	}

}

?>