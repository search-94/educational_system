<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('login');
});

Route::match(array('GET', 'POST'), 'login', array('uses'=>'UserLoginController@user'));

Route::group(array('before' => 'auth'), function() {

	Route::group(array('before' => 'admin'), function()
	{
		Route::get('admin/index', function(){
			
			return View::make('admin.index');
		});

		//Route::post('admin/index', 'AdminUserController@upload');
		//Route::get('/admin/user/download','AdminUserController@download');

		Route::post('/admin/user/store','AdminUserController@store');
		Route::post('admin/user/info', 'AdminUserController@info');	//ajax
		Route::post('admin/user/update','AdminUserController@update');
		Route::get('/admin/user/destroy/{id}','AdminUserController@destroy');
		Route::post('admin/user/restore','AdminUserController@restore');
		Route::controller('admin/user','AdminUserController');

		Route::get('ruta',array('as' => 'input_interfaces::info_tab'), function() {

		});

		Route::post('/admin/subject/store','AdminSubjectController@store');
		Route::post('admin/subject/info', 'AdminSubjectController@info');	//ajax	
		Route::post('/admin/subject/update/{id}','AdminSubjectController@update');
		Route::get('/admin/subject/destroy/{id}','AdminSubjectController@destroy');
		Route::controller('admin/subject','AdminSubjectController');	
	});	

	Route::group(array('before' => 'teacher'), function()
	{
		Route::get('teacher/index', function(){
			return View::make('teacher.index');
		});

		Route::post('/teacher/homework/store','TeacherHomeworkController@store');
		Route::post('/teacher/homework/update/{id}','TeacherHomeworkController@update');
		Route::get('/teacher/homework/destroy/{id}','TeacherHomeworkController@destroy');
		Route::controller('teacher/homework','TeacherHomeworkController');

		Route::post('/teacher/score/store','TeacherScoreController@store');
		Route::post('/teacher/score/update/{id}','TeacherScoreController@update');
		Route::get('/teacher/score/destroy/{id}','TeacherScoreController@destroy');
		Route::controller('teacher/score','TeacherScoreController');
	});

	Route::group(array('before' => 'student'), function()
	{
		Route::get('student/index', function(){
			return View::make('student.index');
		});

		Route::post('/student/homework/store','StudentHomeworkController@store');
		Route::controller('student/homework','StudentHomeworkController');

		Route::controller('student/score','StudentScoreController');
	});

});





