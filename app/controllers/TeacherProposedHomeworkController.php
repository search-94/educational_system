<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherProposedHomeworkController extends BaseController {

	public function getCreate() {

		$id_user = Auth::user()->id;

		$user_subjects = new UserSubject();

		$subjects = $user_subjects->getSubjectsFromTeacher($id_user);

		$current_date = date("Y-m-d");		

		return View::make('teacher.proposed_homework.create')->with('subjects', $subjects)->with('current_date', $current_date);
	}

	public function store() {

		$message = new MessageBag();
		$proposed_homework = new ProposedHomework();

		$int = (int)Input::get('id_subject');
		Input::merge(['id_subject'=>$int]);

		$int = (int)Input::get('weighing');
		Input::merge(['weighing'=>$int]);		

		$result = $proposed_homework->reject(Input::all());

		if ($result) {
			
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			if (Input::get('culmination_date') < Input::get('current_date')) {

				Session::flash('message', Lang::get("teacher.homework.error.culmination_date"));
				Session::flash('class', 'danger');
			} else {

				$count = 0;
				$total_proposed_homeworks = $proposed_homework->getProposedHomeworks(Input::get('id_subject'));
				foreach ($total_proposed_homeworks as $total_proposed_homework) {

					$count = $count + $total_proposed_homework->weighing;
				}
				$total_weighing = $count + Input::get('weighing');
				if ($total_weighing > 100) {

					Session::flash('message', Lang::get("teacher.proposed_homework.error.total_weighing"));
					Session::flash('class', 'danger');
				} else {

					$message->add('success', Lang::get('teacher.proposed_homework.created_successfully'));
					$proposed_homework->createHomework(Input::all());
					Session::flash('message', $message->getMessageBag()->first());
					Session::flash('class', 'success');
				}


			}
		}	
        
		return Redirect::to('teacher/proposed_homework/create');

	}

	public function getShow() {

		$id_user = Auth::user()->id;
		$user_subjects = new UserSubject();
		$subjects = $user_subjects->getSubjectsFromTeacher($id_user);
		return View::make('teacher/proposed_homework/show')->with('subjects', $subjects);  
	}

	public function download($id_proposed_homework) {

		$file = ProposedHomework::find($id_proposed_homework)->route;
        return Response::download($file);
	}

	public function info() {

		if(Request::ajax()) {

			$id_subject = Input::get('subject');

	        $proposed_homeworks = new ProposedHomework();
	        $proposed_homeworks = $proposed_homeworks->getProposedHomeworks($id_subject);

	        $current_date = date("Y-m-d");

	        $done_homeworks = new DoneHomework();

	        foreach ($proposed_homeworks as $proposed_homework) {

	        	$unevaluated_homeworks = $done_homeworks->countUnevaluatedDoneHomeworks($proposed_homework->id);
	        	$proposed_homework->unevaluated_homeworks = $unevaluated_homeworks;

	        	$spanish_date = date('d-m-Y', strtotime($proposed_homework->culmination_date));
	        	$proposed_homework->spanish_culmination_date = $spanish_date;
        	 	if ($current_date <= $proposed_homework->culmination_date) { //send period

        	 		$proposed_homework->state = '0'; //En curso
	        	} else {

        	 		$proposed_homework->state = '1'; //Finalizado
	        	}
	        }

        	echo json_encode($proposed_homeworks);

	    }

	}

}

?>