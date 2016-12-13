<?php

class Grade extends Eloquent {

	protected $table = 'grades';

	public function getStudentGrade($id_grade) {

		$grade = Grade::find($id_grade);
		return $grade;
	}
}
?>