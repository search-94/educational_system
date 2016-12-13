<?php

class GenderTableSeeder extends Seeder {

	public function run()
	{

		DB::table('genders')->delete();

		Gender::create(array(
			'description'	=> 'Femenino',
		));

		Gender::create(array(
			'description'	=> 'Masculino',
		));	

	}

}