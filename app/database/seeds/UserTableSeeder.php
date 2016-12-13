<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

//.....................................Administrators.........................................		

		User::create(array(
			'identity_card' => '20000000',
			'password' 		=> Hash::make('root'),
			'first_name' 	=> 'Maribel',
			'second_name' 	=> 'Fernández',
			'id_gender'	  	=> 1,
			'id_role' 		=> 1,
			
		));

//........................................Teachers............................................		

		User::create(array(
			'identity_card' => '10000000',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Samuel',
			'second_name' 	=> 'Varela',
			'id_gender' 	=> 2,
			'id_role' 		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '10000001',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Orlando',
			'second_name' 	=> 'Ochoa',
			'id_gender' 	=> 2,
			'id_role' 		=> 2,
			
		));

		User::create(array(
			'identity_card' => '10000002',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Luis',
			'second_name' 	=> 'Becerra',
			'id_gender' 	=> 2,
			'id_role' 		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '10000003',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'José',
			'second_name' 	=> 'Fajardo',
			'id_gender' 	=> 2,
			'id_role' 		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '10000004',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carlos',
			'second_name' 	=> 'De Abreu',
			'id_gender' 	=> 2,
			'id_role' 		=> 2,
			
		));

		User::create(array(
			'identity_card' => '10000005',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Josefina',
			'second_name' 	=> 'Andrade',
			'id_gender' 	=> 1,
			'id_role' 		=> 2,
			
		));	

		User::create(array(
			'identity_card' => '10000006',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Constanza',
			'second_name' 	=> 'Martin',
			'id_gender' 	=> 1,
			'id_role' 		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '10000007',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Eveatriz',
			'second_name' 	=> 'Mutach',
			'id_gender' 	=> 1,
			'id_role' 		=> 2,
			
		));						

		User::create(array(
			'identity_card' => '10000008',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Ramona',
			'second_name' 	=> 'Hernández',
			'id_gender' 	=> 1,
			'id_role' 		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '10000009',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Marisol',
			'second_name' 	=> 'Miño',
			'id_gender' 	=> 1,
			'id_role' 		=> 2,
			
		));				

//......................................Students............................................			

		User::create(array(
			'identity_card' => '30000100',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carlos',
			'second_name' 	=> 'González',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));

		User::create(array(
			'identity_card' => '30000101',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Felipe',
			'second_name' 	=> 'Álvarez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));		

		User::create(array(
			'identity_card' => '30000102',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Juan',
			'second_name' 	=> 'Rodriguez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));			

		User::create(array(
			'identity_card' => '30000103',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Camilo',
			'second_name' 	=> 'Pereira',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));	

		User::create(array(
			'identity_card' => '30000104',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Alexander',
			'second_name' 	=> 'Peraza',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));		

		User::create(array(
			'identity_card' => '30000105',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Maria',
			'second_name' 	=> 'Vivas',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));		

		User::create(array(
			'identity_card' => '30000106',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Mariana',
			'second_name' 	=> 'Rodriguez',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));		

		User::create(array(
			'identity_card' => '30000107',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Eliana',
			'second_name' 	=> 'Hernández',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));								

		User::create(array(
			'identity_card' => '30000108',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Flor',
			'second_name' 	=> 'Sánchez',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));		

		User::create(array(
			'identity_card' => '30000109',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carmen',
			'second_name' 	=> 'Morán',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 1,
			
		));			

		User::create(array(
			'identity_card' => '30000200',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Martín',
			'second_name' 	=> 'Tovar',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));

		User::create(array(
			'identity_card' => '30000201',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Fernando',
			'second_name' 	=> 'Ruette',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000202',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Pedro',
			'second_name' 	=> 'Rondón',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));			

		User::create(array(
			'identity_card' => '30000203',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Kevin',
			'second_name' 	=> 'Ponte',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));	

		User::create(array(
			'identity_card' => '30000204',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Juan',
			'second_name' 	=> 'Pérez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000205',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Karina',
			'second_name' 	=> 'Rodriguez',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000206',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Mary',
			'second_name' 	=> 'Harrison',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000207',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Julia',
			'second_name' 	=> 'Abreu',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));								

		User::create(array(
			'identity_card' => '30000208',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Camila',
			'second_name' 	=> 'Rosas',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000209',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carmen',
			'second_name' 	=> 'Morán',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 2,
			
		));		

		User::create(array(
			'identity_card' => '30000300',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'José',
			'second_name' 	=> 'Rondón',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));

		User::create(array(
			'identity_card' => '30000301',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Andrés',
			'second_name' 	=> 'Pérez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000302',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Luis',
			'second_name' 	=> 'Tovar',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));			

		User::create(array(
			'identity_card' => '30000303',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Mariano',
			'second_name' 	=> 'Da Silva',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));	

		User::create(array(
			'identity_card' => '30000304',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Luís',
			'second_name' 	=> 'Rivera',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000305',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'María',
			'second_name' 	=> 'Fernández',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000306',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Mary',
			'second_name' 	=> 'Harrison',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000307',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Julia',
			'second_name' 	=> 'Abreu',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));								

		User::create(array(
			'identity_card' => '30000308',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Maribel',
			'second_name' 	=> 'González',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000309',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carmen',
			'second_name' 	=> 'Morán',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 3,
			
		));		

		User::create(array(
			'identity_card' => '30000400',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Dario',
			'second_name' 	=> 'Álvarez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));

		User::create(array(
			'identity_card' => '30000401',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Andrés',
			'second_name' 	=> 'López',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000402',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Marcelo',
			'second_name' 	=> 'Paredes',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));			

		User::create(array(
			'identity_card' => '30000403',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Iván',
			'second_name' 	=> 'Diaz',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));	

		User::create(array(
			'identity_card' => '30000404',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Alfredo',
			'second_name' 	=> 'Peña',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000405',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Rosa',			
			'second_name' 	=> 'Colmenarez',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000406',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Laura',
			'second_name' 	=> 'Arango',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000407',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Alejandra',
			'second_name' 	=> 'Capote',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));								

		User::create(array(
			'identity_card' => '30000408',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Lucía',
			'second_name' 	=> 'Peña',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000409',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'María',
			'second_name' 	=> 'Martínez',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 4,
			
		));		

		User::create(array(
			'identity_card' => '30000500',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Kevin',
			'second_name' 	=> 'Zambrano',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));

		User::create(array(
			'identity_card' => '30000501',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Rafael',
			'second_name' 	=> 'De Abreu',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

		User::create(array(
			'identity_card' => '30000502',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carlos',
			'second_name' 	=> 'Rodriguez',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));			

		User::create(array(
			'identity_card' => '30000503',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Joam',
			'second_name' 	=> 'Rodrigues',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));	

		User::create(array(
			'identity_card' => '30000504',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Luís',
			'second_name' 	=> 'Alcantara',
			'id_gender' 	=> 2,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

		User::create(array(
			'identity_card' => '30000505',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Luisa',
			'second_name' 	=> 'Quesada',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

		User::create(array(
			'identity_card' => '30000506',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Carla',
			'second_name' 	=> 'Alfaro',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

		User::create(array(
			'identity_card' => '30000507',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Jimena',
			'second_name' 	=> 'Cuevas',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));								

		User::create(array(
			'identity_card' => '30000508',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Andrea',
			'second_name' 	=> 'Torres',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

		User::create(array(
			'identity_card' => '30000509',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Adriana',
			'second_name' 	=> 'Quijada',
			'id_gender' 	=> 1,
			'id_role' 		=> 3,
			'id_grade'		=> 5,
			
		));		

//.................................Coordinators..............................................

		User::create(array(
			'identity_card' => '11000000',
			'password' 		=> Hash::make('123456'),
			'first_name' 	=> 'Samuel',
			'second_name' 	=> 'Álvarez',
			'id_gender'	  	=> 2,
			'id_role' 		=> 4,
			
		));



	}
}
?>