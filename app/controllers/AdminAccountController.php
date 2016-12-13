<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class AdminAccountController extends BaseController {

	public function getPassword() {

		return View::make('admin.account.password');
	}

	public function getLogout() {

		Session::flush();
		return Redirect::to('login');
	}

	public function update() {

		$message = new MessageBag();
		$user = new User;

		$result = $user->passwordReject(Input::all());
		if ($result) {

			$message->add('error', $result->errors()->first());
			Session::flash('message', $message->getMessageBag()->first());
			Session::flash('class', 'danger');
		} else {

			$actual_password = Auth::user()->password;
			$actual_password_introduced = Input::get('actual_password_introduced');
			$new_password = Input::get('new_password');
			$confirm_password = Input::get('confirm_password');

			//if 
 			if (Hash::check($actual_password_introduced, $actual_password) == false) {

				Session::flash('message', Lang::get('account.error.password_introduced'));
				Session::flash('class', 'danger');
			} else {

				if ($new_password != $confirm_password) {

					Session::flash('message', Lang::get('account.error.password_confirm'));
					Session::flash('class', 'danger');
				} else {

					$message->add('success', Lang::get('account.password_changed_successfully'));
					$user->updatePassword(Input::all());
					Session::flash('message', $message->getMessageBag()->first());
					Session::flash('class', 'success');

				}

			}


		}	
        
		return Redirect::to('admin/account/password');
	}

}