<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminSubjectController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$grades = Grade::all();
		$users = User::where('id_role', '2')->get();
		return View::make('admin.subject.create')->with('grades', $grades)->with('users', $users);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$message = new MessageBag();
		$subject = new Subject();
		$user_subject = new UserSubject();

		$result = $subject->reject(Input::all());
		if ($result) {

			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			$result2 = $user_subject->reject(Input::all());
			if ($result2) {

				$message->add('error', $result2->errors()->first());
				Session::flash('message', $message->getMessageBag()->first());
				Session::flash('class', 'danger');
			} else {

				$message->add('success', Lang::get('admin.subject.created_successfully'));
				$id_subject = $subject->createSubject(Input::all());
				$user_subject->createUserSubject(Input::get('id_user'), $id_subject);
				Session::flash('message', $message->getMessageBag()->first());
				Session::flash('class', 'success');
			}

		}	
        
		return Redirect::to('admin/subject/create');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow() {

		$teachers = User::where('id_role', 2)->get();
		$grades = Grade::all();

		return View::make('admin/subject/show')->with('grades', $grades)->with('teachers', $teachers);
	}

	public function info_subjects() {

		if(Request::ajax()) {

			$id_grade = Input::get('grade');

	        $user_subjects = new UserSubject();
	        $user_subjects = $user_subjects->getSubjectTeacher($id_grade);   
        	echo json_encode($user_subjects);
	    }
	}	


	public function info() {

		if(Request::ajax()) {

			//get id of the selected subject
			$id_subject = Input::get('id_subject');
			//query of the subject
			$user_subject = UserSubject::where('id_subject', '=', $id_subject)->first();

			if ($user_subject != null) {

				$user_identity_card = $user_subject->user->identity_card;
				$user_first_name = $user_subject->user->first_name;
				$user_second_name = $user_subject->user->second_name;

				$subject_id = $user_subject->subject->id;
				$subject_name = $user_subject->subject->name;
				$subject_id_grade = $user_subject->subject->id_grade;

				$user_subject_array = array('user_identity_card' => $user_identity_card, 'user_first_name' => $user_first_name, 
					'user_second_name' => $user_second_name, 'subject_id' => $subject_id, 'subject_name' => $subject_name, 'subject_id_grade' => $subject_id_grade);

				echo json_encode($user_subject_array);

			} else {

				$subject = Subject::find($id_subject);
				$subject_name = $subject->name;
				$subject_id_grade = $subject->id_grade;

				$subject_array = array('subject_name' => $subject_name, 'subject_id_grade' => $subject_id_grade);

				echo json_encode($subject_array);
			}
	
	    }
	        
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$user_subject = new UserSubject();
		$user_subject->destroyUserSubject($id);

		$subject = new Subject();
		$subject->destroySubject($id);

		Session::flash('message', Lang::get('admin.subject.deleted_successfully'));
		Session::flash('class', 'success');

		return Redirect::to('admin/subject/show');
	}

	public function assignTeacher() {

		$message = new MessageBag();
		$user_subject = new UserSubject();

		$result = $user_subject->reject(Input::all());
		if ($result) {

			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			$message->add('success', Lang::get('admin.subject.assigned_successfully'));
			$user_subject->assignTeacher(Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	

		return Redirect::to('admin/subject/show');
	}


	public function unassignTeacher($id) {

		$user_subject = new UserSubject();
		$user_subject = $user_subject->unassignTeacher($id);
		Session::flash('message', Lang::get('admin.subject.unassigned_successfully'));
		Session::flash('class', 'success');
		return Redirect::to('admin/subject/show');
	}
}
