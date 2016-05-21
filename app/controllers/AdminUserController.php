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
		$roles = Role::all();
		$grades = Grade::all();
		return View::make('admin.user.create')->with('roles', $roles)->with('grades', $grades);
	}

/*
	public function upload()
	{
		$file = Input::file('file');
		$destinationPath = public_path()."/uploads/";
		// If the uploads fail due to file system, you can try doing public_path().'/uploads' 
		$filename = $file->getClientOriginalName();
		$extension =$file->getClientOriginalExtension(); 
		$upload_success = Input::file('file')->move($destinationPath, $filename);

		if( $upload_success ) {
		   return Response::json('success', 200);
		} else {
		   return Response::json('error', 400);
		}
	}

		public function download()
	{

        //PDF file is stored under project/public/download/info.pdf
        $file= public_path()."/uploads/asd.docx";
        $headers = array(
              'Content-Type'=> 'application/msword',
            );
        return Response::download($file, 'filename.docx', $headers);

	}
*/

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

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
		$grades = Grade::all();
		return View::make('admin.user.show')->with('roles', $roles)->with('grades', $grades);
	}

	public function info() {

		if(Request::ajax()) {

			$id = Input::get('identity_card');
			try {

		        if ($user = User::withTrashed()->where('identity_card', '=', $id)->firstOrFail()) {

		        	$role = $user->role->description;
		        	if ($user->trashed()) {
						$is_active = false;
		        	} else {
		        		$is_active = true;
		        	}
		        	
		        	
		        	if ($user->id_role == 3) {

		        		$user_array = array('id' => $user->id, 'password' => $user->password, 'first_name' => $user->first_name, 'second_name' => $user->second_name, 'role' => $role, 'id_role' => $user->id_role, 'id_grade' => $user->id_grade, 'is_active' => $is_active);
		        	
		        	} else {

		        		$user_array = array('id' => $user->id, 'password' => $user->password, 'first_name' => $user->first_name, 'second_name' => $user->second_name, 'role' => $role, 'id_role' => $user->id_role, 'is_active' => $is_active);
		        	}

		        	echo json_encode($user_array);
		     
				}
			} catch(ModelNotFoundException $e) {
				echo "error";
			}
	    }
	        
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
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		Session::flash('message', 'usuario eliminado correctamente');
		Session::flash('class', 'success');
		return Redirect::to('admin/user/show');
	}

	public function restore() {

		$message = new MessageBag();
		$input = Input::all();
		$user = new User;

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
