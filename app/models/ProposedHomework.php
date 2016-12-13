<?php

class ProposedHomework extends Eloquent {

	protected $table = 'proposed_homeworks';

	function reject($input) {

		$validator = Validator::make (
			$input,
			array(
				'id_subject' 		=> 'required|integer|min:1',
				'name'				=> 'required|alpha_num_spaces|max:100',
				'weighing'			=> 'required|integer|min:5',
				'culmination_date'	=> 'required|date',
				'file'				=> 'required|max:50000',

			)
		);
		if ($validator->fails()) {
	
			return $validator;
		}	

		return false;
	}

	public function createHomework($input) {

		$homework = new ProposedHomework;

		$homework->id_subject = $input['id_subject'];
		$homework->name = $input['name'];
		$homework->weighing = $input['weighing'];
		$homework->culmination_date = $input['culmination_date'];
		$homework->save();

		$file = Input::file('file');
		$destinationPath = public_path()."\\files\proposed_homeworks\\";
		$name = $input['id_subject']."-".$homework->id;
		$extention =$file->getClientOriginalExtension(); 
		$filename = $name.".".$extention;
		$upload_success = Input::file('file')->move($destinationPath, $filename);

		$route = $destinationPath.$filename;
		$homework->route = $route;
		$homework->save();		

	}

	public function getProposedHomeworks($id_subject) {

		$proposed_homeworks = ProposedHomework::where('id_subject', '=', $id_subject)->get();

		return $proposed_homeworks;
	}




}



?>