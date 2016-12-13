<?php

class Content extends Eloquent {

	protected $table = 'contents';

	function reject($input) {

		$validator = Validator::make (
			$input,
			array(
				'id_subject' 	=> 'required|integer|min:1',
				'name'			=> 'required|alpha_num_spaces|max:100',
				'file'			=> 'required|max:100000',
			)
		);
		if ($validator->fails()) {
	
			return $validator;
		}	

		return false;
	}


	public function createContent($input) {

		$content = new Content;
		$content->id_subject = $input['id_subject'];
		$content->name = $input['name'];
		$content->save();

		$file = Input::file('file');
		$destinationPath = public_path()."\\files\contents\\";
		$name = $input['id_subject']."-".$content->id;
		$extention =$file->getClientOriginalExtension(); 
		$filename = $name.".".$extention;
		$upload_success = Input::file('file')->move($destinationPath, $filename);

		$route = $destinationPath.$filename;
		$content->route = $route;
		$content->save();		

	}

	public function getContents($id_subject) {

		$contents = Content::where('id_subject', '=', $id_subject)->get();

		return $contents;
	}



	public function deleteContent($id_content) {

		$content = Content::find($id_content);
		if ($content->delete()) {

			return true;
		} else {

			return false;
		}
	}



}
?>