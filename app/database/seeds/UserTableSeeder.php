<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'identity_card' => '20000000',
			'password' => Hash::make('root'),
			'first_name' => 'Admin',
			'second_name' => 'Admin',
			'id_role' => '1',
			
		));

		User::create(array(
			'identity_card' => '12345678',
			'password' => Hash::make('123456'),
			'first_name' => 'Carmen',
			'second_name' => 'Rojas',
			'id_role' => '2',
			
		));

		User::create(array(
			'identity_card' => '29504002',
			'password' => Hash::make('123456'),
			'first_name' => 'Samuel',
			'second_name' => 'Varela',
			'id_role' => '2',
			
		));

		User::create(array(
			'identity_card' => '15123123',
			'password' => Hash::make('123456'),
			'first_name' => 'Josefina',
			'second_name' => 'Andrade',
			'id_role' => '2',
			
		));		

		User::create(array(
			'identity_card' => '26505430',
			'password' => Hash::make('123456'),
			'first_name' => 'Carlos',
			'second_name' => 'González',
			'id_role' => '3',
			'id_grade'		=> '1',
			
		));

		User::create(array(
			'identity_card' => '25570470',
			'password' => Hash::make('123456'),
			'first_name' => 'María',
			'second_name' => 'Perez',
			'id_role' => '3',
			'id_grade' => '2',
			
		));

		User::create(array(
			'identity_card' => '27234506',
			'password' => Hash::make('123456'),
			'first_name' => 'Luis',
			'second_name' => 'Quintero',
			'id_role' => '3',
			'id_grade' 	=> '3',
			
		));

	}
}
?>