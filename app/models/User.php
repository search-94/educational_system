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
						'first_name'	=> 'required|alpha_spaces|min:2|max:30',
						'second_name'	=> 'required|alpha_spaces|min:2|max:30',
						'id_gender'		=> 'required|integer|min:1|max:2',
						'id_role'		=> 'required|integer|min:1|max:4',
						'id_grade'		=> 'required|integer|min:1|max:5'
					)
				);
			} else {

				$validator = Validator::make (
					$input,
					array(
						'identity_card' => 'required|digits_between:5,10|unique:users,identity_card', 
						'first_name'	=> 'required|alpha_spaces|min:2|max:30',
						'second_name'	=> 'required|alpha_spaces|min:2|max:30',
						'id_gender'		=> 'required|integer|min:1|max:2',
						'id_role'		=> 'required|integer|min:1|max:4'
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
		$user->password = Hash::make($input['identity_card']);
		$user->first_name = $input['first_name'];
		$user->second_name = $input['second_name'];
		$user->id_gender = $input['id_gender'];
		$user->id_role = $input['id_role'];
		$user->id_grade = $input['id_grade'] ?: null;
		$user->save();
	}

	public function updateReject($input) {

		$validator = Validator::make (
			$input,
			array(
				'update_first_name'		=> 'required|alpha_spaces|min:2|max:30',
				'update_second_name'	=> 'required|alpha_spaces|min:2|max:30',
				'update_gender'			=> 'required|integer|min:1|max:2'
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
		$user->id_gender = $input['update_gender'];

		if ($input['r_pass'] == 'true') {
			Log::info(Hash::make($input['update_identity_card']));
			$user->password = Hash::make($input['update_identity_card']);
		} 

		$user->save();
	}

	public function destroyUser($id) {

		$user = User::find($id);
		if ($user->delete()) {

			return true;
		} else {
			
			return false;
		}
		
	}

	public function restoreReject($input) {

		if ($input['restore_id_role'] == '3') {

			$validator = Validator::make (
				$input,
				array(
					'restore_first_name'	=> 'required|alpha_spaces|min:2|max:30',
					'restore_second_name'	=> 'required|alpha_spaces|min:2|max:30',
					'restore_id_gender'		=> 'required|integer|min:1|max:2',
					'restore_id_role'		=> 'required|integer|min:1|max:3',
					'restore_id_grade'		=> 'required|integer|min:1|max:5'
				)
			);
		} else {

			$validator = Validator::make (
				$input,
				array(
					'restore_first_name'	=> 'required|alpha_spaces|min:2|max:30',
					'restore_second_name'	=> 'required|alpha_spaces|min:2|max:30',
					'restore_id_gender'		=> 'required|integer|min:1|max:2',
					'restore_id_role'		=> 'required|integer|min:1|max:3',
				)
			);
		}



		if ($validator->fails()) {
			
			return $validator;
		}

		return false;
	}

	public function restoreUser($input) {

		$user = User::onlyTrashed()->where('id', $input['restore_user_id'])->restore();
		$user = User::find($input['restore_user_id']);
		$user->password = Hash::make($input['restore_identity_card']);
		$user->first_name = $input['restore_first_name'];
		$user->second_name = $input['restore_second_name'];
		$user->id_gender = $input['restore_id_gender'];
		$user->id_role = $input['restore_id_role'];
		$user->id_grade = $input['restore_id_grade'] ?: null;
		$user->save();
		
	}

	public function role() {

		return $this->hasOne('Role', 'id', 'id_role');

	}

	public function gender() {

		return $this->hasOne('Gender', 'id', 'id_gender');

	}	

	public function passwordReject($input) {

		$validator = Validator::make (
			$input,
			array(
				'new_password'	=> 'required|alpha_dash|min:6|max:12',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}

		return false;
	}

	public function updatePassword($input) {

		$id = Auth::user()->id;
		$user = User::find($id);
		$user->password = Hash::make($input['new_password']);
		$user->save();
	}

	public function getStudents() {

		$students = User::where('id_grade', '<>', '')->get();
		return $students;
	}

	public function updateStudentGrade($id) {

		$user = User::find($id);
		$user->id_grade = $user->id_grade + 1;
		$user->save();

	}

}
