<?php

class GradeTableSeeder extends Seeder {

	public function run()
	{

		DB::table('grades')->delete();

		Grade::create(array(
			'description'	=> '1° Año',
		));

		Grade::create(array(
			'description'	=> '2° Año',
		));

		Grade::create(array(
			'description'	=> '3° Año',
		));

		Grade::create(array(
			'description'	=> '4° Año',
		));

		Grade::create(array(
			'description'	=> '5° Año',
		));

	}

}