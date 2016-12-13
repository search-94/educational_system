<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeacherContentController extends BaseController {

	public function getCreate() {

		$id_user = Auth::user()->id;

		$user_subjects = new UserSubject();

		$subjects = $user_subjects->getSubjectsFromTeacher($id_user);

		return View::make('teacher.content.create')->with('subjects', $subjects);
	}

	public function store() {

		$message = new MessageBag();
		$content = new Content();

		$int = (int)Input::get('id_subject');
		Input::merge(['id_subject'=>$int]);

		$result = $content->reject(Input::all());

		if ($result) {
			
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			$message->add('success', Lang::get('teacher.content.created_successfully'));
			$content->createContent(Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	
        
		return Redirect::to('teacher/content/create');

	}

	public function getShow() {

		$id_user = Auth::user()->id;
		$user_subjects = new UserSubject();
		$subjects = $user_subjects->getSubjectsFromTeacher($id_user);

		return View::make('teacher/content/show')->with('subjects', $subjects);
	}

	public function info() {


		if(Request::ajax()) {

			$id_subject = Input::get('subject');

	        $contents = new Content();
	        $contents = $contents->getContents($id_subject);


	        foreach ($contents as $content) {

	        	$spanish_date = date('d-m-Y', strtotime($content->created_at));
	        	$content->spanish_creation_date = $spanish_date;
	        }	        

        	echo json_encode($contents);
		     				
	    }
	}

	public function download($id_content) {

		$file= Content::find($id_content)->route;
        return Response::download($file);
	}

	public function destroy($id_content) {

		$file= Content::find($id_content)->route;
		File::delete($file);

		$content = new Content();
		if ($content->deleteContent($id_content)) {

			Session::flash('message', Lang::get('teacher.content.deleted_successfully'));
			Session::flash('class', 'success');
			return Redirect::to('teacher/content/show');

		} else {


		}
	}


}