<?php

class PeriodTableSeeder extends Seeder {

	public function run()
	{

		DB::table('periods')->delete();

		Period::create(array(
			'year' => '2015',
			'lapse' => '3',
		));

	}

}