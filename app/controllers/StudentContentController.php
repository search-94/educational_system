<?php

	class StudentContentController extends BaseController {

	public function getShow() {

		$id_grade = Auth::user()->id_grade;
		$subjects = new Subject();
		$subjects = $subjects->getSubjects($id_grade);
		return View::make('student/content/show')->with('subjects', $subjects);
	}

	protected function download($id_content) {

		$file= Content::find($id_content)->route;
        return Response::download($file);
	}

	public function info() {

		if(Request::ajax()) {

			$id_subject = Input::get('subject');

	        $contents = new Content();
	        $contents = $contents->getContents($id_subject);


	        foreach ($contents as $content) {

	        	$spanish_date = date('d-m-Y', strtotime($content->created_at));
	        	$content->spanish_creation_date = $spanish_date;
	        }	        

        	echo json_encode($contents);
	    }
	}

} 