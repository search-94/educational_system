<?php

class RoleTableSeeder extends Seeder {

	public function run()
	{

		DB::table('roles')->delete();

		Role::create(array(
			'Description' => 'Admin',
		));

		Role::create(array(
			'Description' => 'Profesor',
		));

		Role::create(array(
			'Description' => 'Estudiante',
		));		

		Role::create(array(
			'Description' => 'Coordinador',
		));		

	}

}