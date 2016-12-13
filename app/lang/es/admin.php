<?php

	return array(
		'menu' => array(
			'admin' 		=> 'Administrador',
			'f_admin' 		=> 'Administradora',
			'm_admin' 		=> 'Administrador',
			'home'			=> 'Inicio',
			'users' 		=> 'Usuarios',
			'subjects'    	=> 'Materias',		
			'period'		=> 'Período',
		),

		'user' => array(

			'user'			=> 'Usuario',
			'manage'		=> 'Gestión de Usuarios',
			'information'	=> 'Información de Usuario',
			'create'		=> 'Nuevo Usuario',
			'id'			=> 'Cédula de Identidad',
			'password' 		=> 'Contraseña',
			'first_name'	=> 'Nombre',
			'second_name'	=> 'Apellido',
			'gender'		=> 'Género',
			'select_gender'	=> 'Seleccione el género',
			'role'			=> 'Rol',
			'select_role'	=> 'Seleccione el rol',
			'grade'			=> 'Grado',
			'select_grade'	=> 'Seleccione el grado',
			'state'			=> 'Estado',
			'identity_card' => 'C.I.',

			//validations

			'error' => array(
				'identity_card' => 'El número de cédula debe contener entre 5 y 10 caracteres',
				'first_name'	=> 'El nombre del usuario debe contener entre 2 y 30 caracteres alfabéticos',
				'second_name'	=> 'El apellido del usuario debe contener entre 2 y 30 caracteres alfabéticos',
				'gender'		=> 'Seleccione el género del usuario',
				'role' 			=> 'Seleccione el rol del usuario',
				'grade'			=> 'Seleccione el grado que cursa el estudiante',
			),

			'created_successfully' => 'Usuario creado correctamente',
			'updated_successfully' => 'Usuario modificado correctamente',

			'delete_confirm'		=> '¿Desea eliminar al usuario?',
			'deleted_successfully'	=>'Usuario eliminado correctamente',
			'restore_password'		=> 'Restaurar contraseña',

		),

		'subject' => array(
			'manage'		=> 'Gestión de Materias',
			'information'	=> 'Información de Materia',
			'create'		=> 'Nueva Materia',
			'name' 			=> 'Nombre',
			'grade'			=> 'Grado',
			'select_grade'	=> 'Seleccione el grado',
			'teacher'		=> 'Profesor',
			'select_teacher'=> 'Seleccione el profesor',
			'options'		=> 'Opciones',


			//validations
			'error' => array(
				'name' 		=> 'El nombre de la materia debe contener entre 2 y 30 caracteres alfanuméricos',
				'grade'   	=> 'Seleccione el grado en el cual se imparte la materia',
				'user'		=> 'Seleccione el profesor asignado a la materia',

			),

			'created_successfully' => 'Materia creada correctamente',

			'assigned_successfully'=> 'Profesor asignado correctamente',

			'unassigned_successfully'=> 'Profesor retirado correctamente',
	
			'empty_teacher'			=>	'Seleccione el profesor que tendrá la materia',

			'empty_subject'			=> 'No existen materias asociadas al grado seleccionado',
	
			'unassign' => array(
	
				'title' => 'Retirar profesor',
				'content' => '¿Desea retirar al profesor de la materia?',
			),

			'deleted_successfully'=> 'Materia eliminada correctamente',

			//options
			'select_assign_teacher' => 'Seleccione el profesor asignado a la materia',
			'assign_teacher' 		=> 'Asignar profesor',
			'unassign_teacher'		=> 'Retirar profesor',
			'delete'				=> 'Eliminar',
			'info'					=> 'Info',
			'infor'					=> 'Información',

			'subject_info'			=> 'Información sobre la materia',
			'teacher_info'			=> 'Información sobre el profesor',

			'del'	=> 'Eliminar',
			//modal
			'delete' => array(

				'title'   => 'Eliminar materia',
				'content' => '¿Desea eliminar la materia?',
			), 
				
		),

		'period' => array(

			'new_year'		=> 'Año del nuevo período académico',
			'new_lapse' 	=> 'Lapso del nuevo período académico',
			'actual_year'	=> 'Año escolar actual',
			'actual_lapse' 	=> 'Lapso actual',			
			'manage'		=> 'Gestión de Período Académico',
			'create'		=> 'Configuración del Período Académico',
			'year' 			=> 'Año',
			'lapse' 		=> 'Lapso',

			'error' => array(

				'year' => 'Seleccione el año del período académico',
				'lapse'=> 'Seleccione el lapso del período académico',
			),

			'updated_successfully' => 'Período actualizado correctamente',
		)


	);

?>
