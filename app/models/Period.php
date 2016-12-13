<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Period extends Eloquent {

	use SoftDeletingTrait;
 	protected $dates = ['deleted_at'];
	protected $table = 'periods';

	function updatePeriod($input) {

		$done_homeworks = DB::table('done_homeworks')->delete();

		$proposed_homeworks = DB::table('proposed_homeworks')->delete();

		$contents = DB::table('contents')->delete();

		$actual_period = Period::get()->first();
		$actual_period->delete();

		$directory = public_path()."/files/contents/*";
		array_map('unlink', glob($directory));

		$directory = public_path()."/files/done_homeworks/*";
		array_map('unlink', glob($directory));	

		$directory = public_path()."/files/proposed_homeworks/*";
		array_map('unlink', glob($directory));

		$new_period = new Period;
		$new_period->year = $input['year'];
		$new_period->lapse  = $input['lapse'];
		$new_period->save();
				
	}

	public function getActualPeriod() {

		return Period::first();
	}

}


?>