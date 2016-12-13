<?php

class UserSubjectTableSeeder extends Seeder {

public function run()
	{

		DB::table('user_subjects')->delete();

//........................1° Year.............................

		UserSubject::create(array(
			'id_user'	=> 2,
			'id_subject' => 1,
		));

		UserSubject::create(array(
			'id_user'	=> 2,
			'id_subject' => 2,
		));

		UserSubject::create(array(
			'id_user'	=> 2,
			'id_subject' => 3,
		));

		UserSubject::create(array(
			'id_user'	=> 3,
			'id_subject' => 4,
		));

		UserSubject::create(array(
			'id_user'	=> 3,
			'id_subject' => 5,
		));

//.........................2° Year...............................

		UserSubject::create(array(
			'id_user'	=> 3,
			'id_subject' => 6,
		));

		UserSubject::create(array(
			'id_user'	=> 4,
			'id_subject' => 7,
		));

		UserSubject::create(array(
			'id_user'	=> 4,
			'id_subject' => 8,
		));

		UserSubject::create(array(
			'id_user'	=> 4,
			'id_subject' => 9,
		));

		UserSubject::create(array(
			'id_user'	=> 5,
			'id_subject' => 10,
		));	

//.........................3° Year................................

		UserSubject::create(array(
			'id_user'	=> 5,
			'id_subject' => 11,
		));

		UserSubject::create(array(
			'id_user'	=> 5,
			'id_subject' => 12,
		));

		UserSubject::create(array(
			'id_user'	=> 6,
			'id_subject' => 13,
		));

		UserSubject::create(array(
			'id_user'	=> 6,
			'id_subject' => 14,
		));

		UserSubject::create(array(
			'id_user'	=> 6,
			'id_subject' => 15,
		));	

//..............................4° Year..................................		

		UserSubject::create(array(
			'id_user'	=> 7,
			'id_subject' => 16,
		));

		UserSubject::create(array(
			'id_user'	=> 7,
			'id_subject' => 17,
		));

		UserSubject::create(array(
			'id_user'	=> 7,
			'id_subject' => 18,
		));

		UserSubject::create(array(
			'id_user'	=> 8,
			'id_subject' => 19,
		));

		UserSubject::create(array(
			'id_user'	=> 8,
			'id_subject' => 20,
		));			

//...............................5° Year.................................

		UserSubject::create(array(
			'id_user'	=> 8,
			'id_subject' => 21,
		));

		UserSubject::create(array(
			'id_user'	=> 9,
			'id_subject' => 22,
		));

		UserSubject::create(array(
			'id_user'	=> 9,
			'id_subject' => 23,
		));

		UserSubject::create(array(
			'id_user'	=> 10,
			'id_subject' => 24,
		));

		UserSubject::create(array(
			'id_user'	=> 10,
			'id_subject' => 25,
		));		

	}

}