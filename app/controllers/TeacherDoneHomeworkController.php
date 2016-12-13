<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherDoneHomeworkController extends BaseController {

	public function getShow($id_proposed_homework) {

		$proposed_homework = ProposedHomework::find($id_proposed_homework);
		$spanish_date = date('d-m-Y', strtotime($proposed_homework->created_at));
	    $proposed_homework->spanish_creation_date = $spanish_date;

	    $spanish_date = date('d-m-Y', strtotime($proposed_homework->culmination_date));
	    $proposed_homework->spanish_culmination_date = $spanish_date;

		$subject = Subject::where('id', $proposed_homework->id_subject)->first();

		$done_homeworks = new DoneHomework();
		$done_homeworks = $done_homeworks->getDoneHomeworksTeacher($id_proposed_homework);

		foreach($done_homeworks as $done_homework) {

	    	$spanish_date = date('d-m-Y', strtotime($done_homework->created_at));
	    	$done_homework->spanish_creation_date = $spanish_date;

	    	$spanish_date = date('d-m-Y', strtotime($done_homework->updated_at));
	    	$done_homework->spanish_evaluated_date = $spanish_date;	    	
		}

		for ($i=20; $i>0; $i--) {
			$scores[] = $i;
		}

		$period = Period::first();

		return View::make('teacher/done_homework/show')->with('proposed_homework', $proposed_homework)->with('done_homeworks', $done_homeworks)->with('scores', $scores)->with('subject', $subject->name)->with('period', $period);
	}

	public function download($id_done_homework) {

		$file= DoneHomework::find($id_done_homework)->route;
        return Response::download($file);
	}

	public function evaluate($id_done_homework) {

		$message = new MessageBag();
		$done_homework = new DoneHomework();

		$result = $done_homework->rejectEvaluate(Input::all());

		if ($result) {
			
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');

		} else {

			$message->add('success', Lang::get('teacher.done_homework.evaluated_successfully'));
			$done_homework->evaluateDoneHomework($id_done_homework, Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	

		return Redirect::back();
	}

	public function update($id_done_homework) {

		$message = new MessageBag();
		$done_homework = new DoneHomework();

		$result = $done_homework->rejectUpdate(Input::all());

		if ($result) {
			
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');

		} else {

			$message->add('success', Lang::get('teacher.done_homework.evaluated_successfully'));
			$done_homework->updateDoneHomework($id_done_homework, Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	

		return Redirect::back();
	}	

}

?>