<?php

class SubjectTableSeeder extends Seeder {

	public function run()
	{

		DB::table('subjects')->delete();

//........................1° Year.............................

		Subject::create(array(
			'name'	=> 'Castellano',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Inglés',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Matemática',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Estudio de la Naturaleza',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Historia de Venezuela',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Educación Familiar y Ciudadana',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Geografía General',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Educación Artística',
			'id_grade' => '1',
		));

		Subject::create(array(
			'name'	=> 'Educación Física y Deporte',
			'id_grade' => '1',
		));

//.........................2° Year...............................

		Subject::create(array(
			'name'	=> 'Castellano',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Inglés',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Matemática',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Educación para la salud',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Biología',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Historia de Venezuela',
			'id_grade' => '2',
		));

		Subject::create(array(
			'name'	=> 'Historia Universal',
			'id_grade' => '2',
		));	

		Subject::create(array(
			'name'	=> 'Educación Artística',
			'id_grade' => '2',
		));	

		Subject::create(array(
			'name'	=> 'Educación Física',
			'id_grade' => '2',
		));	

//.........................3° Year................................

		Subject::create(array(
			'name'	=> 'Castellano',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Inglés',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Matemática',
			'id_grade' => '3',
		));


		Subject::create(array(
			'name'	=> 'Biología',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Física',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Química',
			'id_grade' => '3',
		));	

		Subject::create(array(
			'name'	=> 'Cátedra Bolivariana',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Geografía',
			'id_grade' => '3',
		));

		Subject::create(array(
			'name'	=> 'Educación Física',
			'id_grade' => '3',
		));

//..............................4° Year..................................		

		Subject::create(array(
			'name'	=> 'Castellano',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Matemática',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Historia de Venezuela',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Inglés',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Educación Física',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Física',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Química',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Biología',
			'id_grade' => '4',
		));

		Subject::create(array(
			'name'	=> 'Dibujo',
			'id_grade' => '4',
		));		

		Subject::create(array(
			'name'	=> 'Psicología',
			'id_grade' => '4',
		));	

		Subject::create(array(
			'name'	=> 'Instrucción Premilitar',
			'id_grade' => '5',
		));

//...............................5° Year.................................

		Subject::create(array(
			'name'	=> 'Inglés',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Educación Física',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Geografía Económica de Vzla.',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Castellano',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Matemática',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Física',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Química',
			'id_grade' => '5',
		));	

		Subject::create(array(
			'name'	=> 'Biología',
			'id_grade' => '5',
		));	

		Subject::create(array(
			'name'	=> 'Ciencias de la Tierra',
			'id_grade' => '5',
		));

		Subject::create(array(
			'name'	=> 'Instrucción Premilitar',
			'id_grade' => '5',
		));

	}

}