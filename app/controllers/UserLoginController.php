<?php

class UserLoginController extends BaseController {

	public function user() {

		if (Request::isMethod('get')) {

		 	return View::make('login.login');
		}

		if (Request::isMethod('post')) {

		 	$userdata = array (
		 		'identity_card' => Input::get('identity_card'),
		 		'password' => Input::get('password')
		 	);

		 	if (Auth::attempt($userdata))
			{
				Session::flash('fail_log', false);

				if (Auth::user()->id_role == 1) {

					return Redirect::to('admin/index');

				} else if (Auth::user()->id_role == 2) {

					return Redirect::to('teacher/index');

				} else if (Auth::user()->id_role == 3) {

					return Redirect::to('student/index');

				} else if (Auth::user()->id_role == 4) {

					return Redirect::to('coordinator/index');
				}

			} else {

				Session::flash('fail_log', true);
				return Redirect::to('login');
		 	}
		}
	}
}

?>