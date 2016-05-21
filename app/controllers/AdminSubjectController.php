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
			}

			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	
        
		return Redirect::to('admin/subject/create');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow()
	{
		//$subjects = DB::table('subjects')->orderBy('id_grade', 'asc')->get();
		$subjects = new UserSubject();
		return View::make('admin.subject.show')->with('subjects', $subjects->getSubjectTeacher());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		//
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
				$user_email = $user_subject->user->email;

				$subject_id = $user_subject->subject->id;
				$subject_name = $user_subject->subject->name;
				$subject_id_grade = $user_subject->subject->id_grade;

				$user_subject_array = array('user_identity_card' => $user_identity_card, 'user_first_name' => $user_first_name, 
					'user_second_name' => $user_second_name, 'user_email' => $user_email, 'subject_id' => $subject_id, 
					'subject_name' => $subject_name, 'subject_id_grade' => $subject_id_grade);

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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$subject = new Subject();
		$subject->destroyUserSubject($id);
	}

	public function destroyUserSubject($id)
	{
		$user_subject = new UserSubject();
		$user_subject->destroyUserSubject($id);
	}

}
