<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminUserController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$genders = Gender::all();
		$roles = Role::all();
		$grades = Grade::all();
		return View::make('admin.user.create')->with('genders', $genders)->with('roles', $roles)->with('grades', $grades);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {

		$message = new MessageBag();
		$user = new User();

		$int = (int)Input::get('id_role');
		Input::merge(['id_role'=>$int]);

		$result = $user->reject(Input::all());
		if ($result) {
			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {
			$message->add('success', Lang::get('admin.user.created_successfully'));
			$user->createUser(Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	
        
		return Redirect::to('admin/user/create');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow()
	{
		$roles = Role::all();
		$genders = Gender::all();
		$grades = Grade::all();
		$id_usr = Auth::user()->id;

		$users = User::all();
		$ids = $users->lists('id');
		$first_names = $users->lists('first_name');
		$second_names = $users->lists('second_name');
		$identity_cards = $users->lists('identity_card');


		for ($i=0; $i<User::count(); $i++) {

			$role = User::find($ids[$i])->role->description;
			$names[$i] = $first_names[$i]." ".$second_names[$i]." - ".$identity_cards[$i]." (".$role.")";
		}

		$names = json_encode($names);

		return View::make('admin.user.show')->with('genders', $genders)->with('roles', $roles)->with('grades', $grades)->with('id_usr', $id_usr)->with('names', $names);
	}

	public function info() {

		if(Request::ajax()) {

			$id = Input::get('identity_card');
			try {

		        if ($user = User::withTrashed()->where('identity_card', '=', $id)->firstOrFail()) {

		        	$role = $user->role->description;
		        	$gender = $user->gender->description;
		        	if ($user->trashed()) {

						$is_active = false;
		        	} else {

		        		$is_active = true;
		        	}
		        	
		        	
		        	if ($user->id_role == 3) {

		        		$user_array = array('id' => $user->id, 'identity_card' => $user->identity_card, 'first_name' => $user->first_name, 'second_name' => $user->second_name, 'gender' => $gender, 'id_gender' => $user->id_gender, 'role' => $role, 'id_role' => $user->id_role, 'id_grade' => $user->id_grade, 'is_active' => $is_active);
		        	
		        	} else {

		        		$user_array = array('id' => $user->id, 'identity_card' => $user->identity_card, 'first_name' => $user->first_name, 'second_name' => $user->second_name, 'gender' => $gender, 'id_gender' => $user->id_gender, 'role' => $role, 'id_role' => $user->id_role, 'is_active' => $is_active);
		        	}

		        	echo json_encode($user_array);
		     
				}
			} catch(ModelNotFoundException $e) {
				echo "error";
			}
	    }
	        
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{

		$message = new MessageBag();
		$user = new User;

		$result = $user->updateReject(Input::all());
		if ($result) {

			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			$message->add('success', Lang::get('admin.user.updated_successfully'));
			$user->updateUser(Input::all());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	
        
		return Redirect::to('admin/user/show');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id_user) {

		$user = new User();
		$deleted_user = User::find($id_user);
		//if the user is teacher, deletes all relations between teacher and subjects
		if ($deleted_user->id_role == 2) {

			$user_subjects = new UserSubject();
			$destroy_user_subjects = $user_subjects->destroyUserSubjectByUser($id_user);
		}
		//if the user is student, deletes all the done homeworks
		else if ($deleted_user->id_role == 3) {

			$done_homeworks = new DoneHomework();
			$destroy_done_homeworks = $done_homeworks->destroyStudentDoneHomeworks($id_user);
		}

		if ($user->destroyUser($id_user)) {

			Session::flash('message', Lang::get('admin.user.deleted_successfully'));
			Session::flash('class', 'success');
			return Redirect::to('admin/user/show');
		}
	}

	public function restore() {

		$message = new MessageBag();
		$input = Input::all();
		$user = new User();

		$result = $user->restoreReject($input);
		if ($result) {

			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');

		} else {

			$message->add('success', Lang::get('admin.user.updated_successfully'));
			$user->restoreUser($input);
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'success');
		}	
		return Redirect::to('admin/user/show');
        
	}


}
