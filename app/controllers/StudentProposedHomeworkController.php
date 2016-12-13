<?php

class StudentProposedHomeworkController extends BaseController {

	public function getShow() {

		$id_grade = Auth::user()->id_grade;
		$subjects = new Subject();
		$subjects = $subjects->getSubjects($id_grade);

		$id_user = Auth::user()->id;

		return View::make('student/proposed_homework/show')->with('subjects', $subjects)->with('id_user', $id_user);
	}

	public function info() {

		if(Request::ajax()) {

			$subject_id = Input::get('subject');

			$subjects = new Subject();
			$user_subjects = new UserSubject();
			$teachers = new User();

	        $proposed_homeworks = new ProposedHomework();
	        $proposed_homeworks = $proposed_homeworks->getProposedHomeworks($subject_id);

	        $done_homework = new DoneHomework();
	        $current_date = date("Y-m-d");

        	$subject = $subjects->getSubject($subject_id);
        	$user_subject = UserSubject::where('id_subject', '=', $subject_id)->first();
        	$teacher = User::find($user_subject->id_user);
	        foreach ($proposed_homeworks as $proposed_homework) {

	        	$proposed_homework->teacher_first_name = $teacher->first_name;
	        	$proposed_homework->teacher_second_name = $teacher->second_name;
	        	$proposed_homework->subject_name = $subject->name;

	        	$spanish_date = date('d-m-Y', strtotime($proposed_homework->culmination_date));
	        	$proposed_homework->spanish_culmination_date = $spanish_date;

	        	$spanish_date = date('d-m-Y', strtotime($proposed_homework->created_at));
	        	$proposed_homework->spanish_creation_date = $spanish_date;

	        	$done = $done_homework->getDoneHomeworkStudent($proposed_homework->id, Auth::user()->id);

        	 	if ($current_date <= $proposed_homework->culmination_date) { //send period

        	 		if ($done == null) {

						$proposed_homework->state = '0'; //Por entregar

        	 		} else {

						if ($done->score != null) {

							$proposed_homework->state = '2'; //corregido
							$proposed_homework->score = $done->score;
							$proposed_homework->observations = $done->observations;

				        	$spanish_date = date('d-m-Y', strtotime($done->created_at));
	        				$proposed_homework->send_date = $spanish_date;

				        	$spanish_date = date('d-m-Y', strtotime($done->updated_at));
	        				$proposed_homework->evaluated_date = $spanish_date;	        				
							
						} else {

							$proposed_homework->state = '1'; //entregado
				        	$spanish_date = date('d-m-Y', strtotime($done->created_at));
	        				$proposed_homework->send_date = $spanish_date;							
							
						}
        	 		}
	        	} else {

	        		if ($done == null) {

						$proposed_homework->state = '3'; //No entregado

        	 		} else {

						if ($done->score != null) {

							$proposed_homework->state = '2'; //Corregido
							$proposed_homework->score = $done->score;
							$proposed_homework->observations = $done->observations;

				        	$spanish_date = date('d-m-Y', strtotime($done->created_at));
	        				$proposed_homework->send_date = $spanish_date;	

				        	$spanish_date = date('d-m-Y', strtotime($done->updated_at));
	        				$proposed_homework->evaluated_date = $spanish_date;	  	        										
							
						} else {

							$proposed_homework->state = '1'; //Entregado

				        	$spanish_date = date('d-m-Y', strtotime($done->created_at));
	        				$proposed_homework->send_date = $spanish_date;							
			
						}							

        	 		}
	        	}
	        }
        	echo json_encode($proposed_homeworks);

	    }
	        
	}

	protected function download($id_proposed_homework) {

		$file= ProposedHomework::find($id_proposed_homework)->route;
        return Response::download($file);
	}

}

?>