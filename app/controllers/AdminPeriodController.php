<?php
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdminPeriodController extends BaseController {

	public function getUpdate() {

		$actual_period = Period::get()->first();

		for ($i=0; $i<90; $i++) {

			$years[$i] = $i+2010;
		}

		for ($i=0; $i<3; $i++) {

			$lapses[$i] = $i+1;
		}

		if ($actual_period != null) {

			$previous_year = $actual_period->year;
			$previous_lapse = $actual_period->lapse;
			return View::make('admin.period.update')->with('years', $years)->with('lapses', $lapses)->with('previous_year', $previous_year)->with('previous_lapse', $previous_lapse);

		} else {

			return View::make('admin.period.update');
		}
	}

	public function update() {

		$message = new MessageBag();
		$period = new Period();

		$int = (int)Input::get('year');
		Input::merge(['year'=>$int]);

		$int = (int)Input::get('lapse');
		Input::merge(['lapse'=>$int]);

		$users = new User();
		$students = $users->getStudents();

		if ($students != null) {

			foreach ($students as $student) {

				if (Input::get('lapse') == 1) {

					if ($student->id_grade == 5) {

						$users->destroyUser($student->id);
					} else {

						$users->updateStudentGrade($student->id);
					}
				}
			}
		}	

		$period->updatePeriod(Input::all());	

		Session::flash('message', Lang::get('admin.period.updated_successfully'));
		Session::flash('class', 'success');
		
		return Redirect::to('admin/period/update');

	}
}