<?php

	return array(
		'menu' => array(

			'home'			=> 'Inicio',
			'users' 		=> 'Usuarios',
			'subjects'    	=> 'Materias',		
		),

		'user' => array(

			'manage'		=> 'Gestión de Usuarios',
			'information'	=> 'Información de Usuario',
			'create'		=> 'Nuevo Usuario',
			'id'			=> 'Cédula de Identidad',
			'password' 		=> 'Contraseña',
			'first_name'	=> 'Nombre',
			'second_name'	=> 'Apellido',
			'role'			=> 'Rol',
			'grade'			=> 'Grado',

			'state'			=> 'Estado',


			//validations

			'error' => array(
				'identity_card' => 'El número de cédula debe contener entre 5 y 10 caracteres',
				'password' 		=> 'La contraseña debe contener entre 5 y 10 caracteres alfanuméricos, guiones o subguiones',
				'first_name'	=> 'El nombre del usuario debe contener entre 2 y 30 caracteres alfabéticos',
				'second_name'	=> 'El apellido del usuario debe contener entre 2 y 30 caracteres alfabéticos',
				'role' 			=> 'Seleccione el rol del usuario',
				'grade'			=> 'Seleccione el grado que cursa el estudiante',
			),

			'created_successfully' => 'Usuario creado correctamente',
			'updated_successfully' => 'Usuario modificado correctamente',

			'delete_confirm' => '¿Desea eliminar al usuario?',

		),

		'subject' => array(
			'subject' 		=> 'Materia',
			'manage'		=> 'Gestión de Materias',
			'information'	=> 'Información de Materia',
			'create'		=> 'Nueva Materia',
			'name' 			=> 'Nombre',
			'grade'			=> 'Grado',
			'teacher'		=> 'Profesor',
			'options'		=> 'Opciones',

			//validations
			'error' => array(
				'name' 		=> 'El nombre de la materia debe contener entre 2 y 30 caracteres alfanuméricos',
				'grade'   	=> 'Seleccione el grado en el cual se imparte la materia',
				'user'		=> 'Seleccione el profesor asignado a la materia',

			),

			'created_successfully' => 'Materia creada correctamente',

			//options
			'assign_teacher' 	=> 'Asignar profesor',
			'unassign_teacher'	=> 'Retirar profesor',
			'delete'			=> 'Eliminar',
			'info'			=> 'Info',
		)

	);

?>
