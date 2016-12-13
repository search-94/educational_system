<?php

class DoneHomework extends Eloquent {

	protected $table = 'done_homeworks';

	public function reject($input) {
		
		$validator = Validator::make(

			$input,
			array(
				'done_homework' => 'required|max:50000',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}
		return false;
	}

	public function createDoneHomework($input, $id_user, $id_proposed_homework) {

		$homework = new DoneHomework;

		$homework->id_proposed_homework = $id_proposed_homework;
		$homework->id_user = $id_user;
		$homework->save();

		$file = Input::file('done_homework');
		$destinationPath = public_path()."\\files\done_homeworks\\";
		$name = $id_proposed_homework."-".$homework->id;
		$extention =$file->getClientOriginalExtension(); 
		$filename = $name.".".$extention;
		$upload_success = Input::file('done_homework')->move($destinationPath, $filename);

		$route = $destinationPath.$filename;
		$homework->route = $route;
		$homework->save();		

	}

	public function getDoneHomeworkStudent($id_proposed_homework, $id_user) {

		$done_homework = DoneHomework::where('id_proposed_homework', '=', $id_proposed_homework)->where('id_user', '=', $id_user)->first();
		return $done_homework;
	}

	public function getDoneHomeworksTeacher($id_proposed_homework) {

		$done_homework = DB::table('done_homeworks')
			->select('done_homeworks.id', 'done_homeworks.id_proposed_homework', 'done_homeworks.id_user', 'done_homeworks.route', 'done_homeworks.score', 'done_homeworks.observations', 'done_homeworks.created_at', 'done_homeworks.updated_at', 'users.identity_card', 'users.first_name', 'users.second_name')
			->where('done_homeworks.id_proposed_homework', '=', $id_proposed_homework)
			->join('users', 'done_homeworks.id_user', '=', 'users.id')
			->get();

		return $done_homework;
	}

	public function getDoneHomework($id_done_homework) {

		$done_homework = DoneHomework::find($id_done_homework);
		return $done_homework;
	}	


	public function rejectEvaluate($input) {

		$validator = Validator::make(

			$input,
			array(
				'score' => 'required|integer',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}
		return false;
	}

	public function evaluateDoneHomework($id_done_homework, $input) {

		$done_homework = new DoneHomework();
		$done_homework = $done_homework->getDoneHomework($id_done_homework);

		$done_homework->score = $input['score'];
		$done_homework->observations = $input['observations'];
		$done_homework->save();
	}


	public function rejectUpdate($input) {

		$validator = Validator::make(

			$input,
			array(
				'update_score' => 'required|integer',
			)
		);

		if ($validator->fails()) {
			return $validator;
		}
		return false;
	}	

	public function updateDoneHomework($id_done_homework, $input) {

		$done_homework = new DoneHomework();
		$done_homework = $done_homework->getDoneHomework($id_done_homework);

		$done_homework->score = $input['update_score'];
		$done_homework->observations = $input['update_observations'];
		$done_homework->save();
	}

	public function countUnevaluatedDoneHomeworks($id_proposed_homework){

		$proposed_homeworks = DoneHomework::where('id_proposed_homework', '=', $id_proposed_homework)->where('score', '=', null)->count();
		return $proposed_homeworks;
	}

	public function destroyStudentDoneHomeworks($id_user) {

		$done_homeworks = DoneHomework::where('id_user', '=', $id_user)->get();
		if ($done_homeworks != null) {

			foreach($done_homeworks as $done_homework) {

				$done_homework->delete();
			}
			
			return true;
		}
		
		return false;
	}
}



?>