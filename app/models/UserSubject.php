<?php

class UserSubject extends Eloquent {

	protected $table = 'user_subjects';

	public function reject($input) {
		$validator = Validator::make (
			$input,
			array(

				'id_user' => 'required|integer', 
			)
		);

		if ($validator->fails()) {
			return $validator;
		}

		return false;
	}

	public function createUserSubject($id_user, $id_subject) {
		$user_subject = new UserSubject;
		$user_subject->id_user = $id_user;
		$user_subject->id_subject = $id_subject;
		$user_subject->save();
	}

	public function destroyUserSubject($id_subject) {

		$user_subject = UserSubject::where('id_subject', $id_subject)->delete();

	}

	public function destroyUserSubjectByUser($id_user) {

		$user_subjects = UserSubject::where('id_user', $id_user)->get();

		if ($user_subjects != null) {

			foreach($user_subjects as $user_subject) {

				$user_subject->delete();
			}
			return true;
		}
		return false;
	}	

	public function getSubjectTeacher($id_grade) {

		$subjects = DB::table('user_subjects')
			->rightJoin('subjects', 'subjects.id', '=', 'user_subjects.id_subject')
            ->leftJoin('users', 'users.id', '=', 'user_subjects.id_user')
            ->select('subjects.id as subject_id','subjects.name as subject_name', 'subjects.id_grade as subject_id_grade', 'users.id as user_id')
            ->whereNull('subjects.deleted_at')
            ->where('subjects.id_grade', '=', $id_grade)
            ->orderBy('subject_id_grade')
            ->get();

        return $subjects;
	}	

	public function getSubjectsFromTeacher($id_user) {

		$subjects = DB::table('user_subjects')
			->select('subjects.id', 'subjects.name', 'subjects.id_grade')
			->join('subjects', 'user_subjects.id_subject', '=', 'subjects.id')
			->where('user_subjects.id_user', '=', $id_user)
			->get();

		return $subjects;
	}

	public function assignTeacher($input) {

		$user_subject = new UserSubject();
		$user_subject->id_subject = $input['id_subject'];
		$user_subject->id_user = $input['id_user'];
		$user_subject->save();
	}

	public function unassignTeacher($id) {

		$user_subject = UserSubject::where('id_subject', $id)->delete();
	}

	public function user() {

		return $this->belongsTo('User', 'id_user', 'id');
	}	

	public function subject() {

		return $this->belongsTo('Subject', 'id_subject', 'id');
	}		
}
?>