<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Subject extends Eloquent {

	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $table = 'subjects';

	public function reject($input) {

		$validator = Validator::make (
			$input,
			array(
				'name' 			=> 'required|alpha_num_spaces|min:2|max:30', 
				'id_grade'		=> 'required|integer|min:1|max:5',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}

		return false;
	}

	public function createSubject($input) {

		$subject = new Subject;
		$subject->name = $input['name'];
		$subject->id_grade = $input['id_grade'];
		$subject->save();
		return $subject->id;
	}


	public function destroySubject($id_subject) {

		$subject = Subject::find($id_subject)->delete();

	}

	public function getSubjects($id_grade) {

		$subjects = Subject::where('id_grade', '=', $id_grade)->get();
		return $subjects;
	}

	public function getSubject($id_subject) {

		$subject = Subject::find($id_subject);
		return $subject;
	}
}