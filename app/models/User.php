<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    protected $dates = ['deleted_at'];

	public function reject($input) {
			if ($input['id_role'] == '3') {

				$validator = Validator::make (
					$input,
						array(
							'identity_card' => 'required|digits_between:5,10|unique:users,identity_card', 
							'password'		=> 'required|alpha_dash|',
							'first_name'	=> 'required|alpha|min:2|max:30',
							'second_name'	=> 'required|alpha|min:2|max:30',
							'id_role'		=> 'required|integer|min:1|max:3',
							'id_grade'		=> 'required|integer|min:1|max:5'
						)
				);
			} else {

				$validator = Validator::make (
					$input,
					array(
						'identity_card' => 'required|digits_between:5,10|unique:users,identity_card', 
						'password'		=> 'required|alpha_dash|',
						'first_name'	=> 'required|alpha|min:2|max:30',
						'second_name'	=> 'required|alpha|min:2|max:30',
						'id_role'		=> 'required|integer|min:1|max:3',
					)
				);
			}



		if ($validator->fails()) {
			
			return $validator;
		}

		return false;
	}

	public function createUser($input) {

		$user = new User;
		$user->identity_card = $input['identity_card'];
		$user->password = Hash::make($input['password']);
		$user->first_name = $input['first_name'];
		$user->second_name = $input['second_name'];
		$user->id_role = $input['id_role'];
		$user->id_grade = $input['id_grade'] ?: null;
		$user->save();
	}

	public function updateReject($input) {
		$validator = Validator::make (
			$input,
			array(
				'update_first_name'	=> 'required|alpha|min:2|max:30',
				'update_second_name'	=> 'required|alpha|min:2|max:30',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}

		return false;
	}

	public function updateUser($input) {

		$user = User::find($input['update_user_id']);
		$user->first_name = $input['update_first_name'];
		$user->second_name = $input['update_second_name'];
		$user->save();
	}

	public function restoreReject($input) {

		if ($input['id_role'] == '3') {

			$validator = Validator::make (
				$input,
				array(
					'password'		=> 'required|alpha_dash|',
					'first_name'	=> 'required|alpha|min:2|max:30',
					'second_name'	=> 'required|alpha|min:2|max:30',
					'id_role'		=> 'required|integer|min:1|max:3',
					'id_grade'		=> 'required|integer|min:1|max:5'
				)
			);
		} else {

			$validator = Validator::make (
				$input,
				array(
					'password'		=> 'required|alpha_dash|',
					'first_name'	=> 'required|alpha|min:2|max:30',
					'second_name'	=> 'required|alpha|min:2|max:30',
					'id_role'		=> 'required|integer|min:1|max:3',
				)
			);
		}



		if ($validator->fails()) {
			
			return $validator;
		}

		return false;
	}

	public function restoreUser($input) {

		$user = User::onlyTrashed()->where('id', $input['user_id'])->restore();
		$user = User::find($input['user_id']);
		$user->password = Hash::make($input['password']);
		$user->first_name = $input['first_name'];
		$user->second_name = $input['second_name'];
		$user->id_role = $input['id_role'];
		$user->id_grade = $input['id_grade'] ?: null;
		$user->save();
		
	}

	public function role() {

		return $this->hasOne('Role', 'id', 'id_role');

	}

}
