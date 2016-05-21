<?php

class SubjectTableSeeder extends Seeder {

	public function run()
	{

		DB::table('subjects')->delete();

		Subject::create(array(
			'name'	=> 'Matemática 7',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Contabilidad 1',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Inglés 3',
			'id_grade' => '3',
		));		


	}

}