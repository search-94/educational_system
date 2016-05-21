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
		$user_subject = UserSubject::where('id_subject', $id_subject)->first();
		$user_subject->delete();
	}

	public function getSubjectTeacher() {

		$subjects = DB::table('user_subjects')
            ->rightJoin('subjects', 'subjects.id', '=', 'user_subjects.id_subject')
            ->leftJoin('users', 'users.id', '=', 'user_subjects.id_user')
            ->select('subjects.id as subject_id','subjects.name as subject_name', 'subjects.id_grade as subject_id_grade', 'users.id as user_id')
            ->orderBy('subject_id_grade')
            ->get();

        return $subjects;
	}	

	public function user() {

		return $this->belongsTo('User', 'id_user', 'id');
	}	

	public function subject() {

		return $this->belongsTo('Subject', 'id_subject', 'id');
	}		
}
?>