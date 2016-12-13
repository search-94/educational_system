<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentDoneHomeworkController extends BaseController {

	public function store($id_user, $id_proposed_homework) {

		$message = new MessageBag();
		$done_homework = new DoneHomework();

		$result = $done_homework->reject(Input::all());

		if ($result) {
			
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');

		} else {
			
			$message->add('success', Lang::get('student.done_homework.created_successfully'));
			$done_homework->createDoneHomework(Input::get('done_homework'), $id_user, $id_proposed_homework);
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');

		}	
        
		return Redirect::to('student/proposed_homework/show');

	}

}

?>