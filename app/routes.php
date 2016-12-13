<?php

Route::get('/', function()
{
	return Redirect::to('login');
});

Route::match(array('GET', 'POST'), 'login', array('uses'=>'UserLoginController@user'));

Route::group(array('before' => 'auth'), function() {

	Route::group(array('before' => 'admin'), function()
	{
		Route::get('admin/index', function() {
			
			return View::make('admin.index');
		});

		Route::post('admin/user/store','AdminUserController@store');
		Route::post('admin/user/info', 'AdminUserController@info');	//ajax
		Route::post('admin/user/update','AdminUserController@update');
		Route::get('admin/user/destroy/{id}','AdminUserController@destroy');
		Route::post('admin/user/restore','AdminUserController@restore');
		Route::controller('admin/user','AdminUserController');

		Route::post('admin/subject/store','AdminSubjectController@store');
		Route::post('admin/subject/info', 'AdminSubjectController@info');	//ajax	
		Route::post('admin/subject/info_subjects', 'AdminSubjectController@info_subjects');	//ajax	
		Route::post('admin/subject/update/{id}','AdminSubjectController@update');
		Route::post('admin/subject/assignTeacher','AdminSubjectController@assignTeacher');
		Route::get('admin/subject/destroy/{id}','AdminSubjectController@destroy');
		Route::get('admin/subject/unassignTeacher/{id}','AdminSubjectController@unassignTeacher');
		Route::controller('admin/subject','AdminSubjectController');	

		Route::post('admin/period/update','AdminPeriodController@update');
		Route::controller('admin/period','AdminPeriodController');		

		Route::post('admin/account/update','AdminAccountController@update');
		Route::controller('admin/account','AdminAccountController');
	});	

	Route::group(array('before' => 'teacher'), function()
	{
		Route::get('teacher/index', function() {

			return View::make('teacher.index');
		});

		Route::post('/teacher/content/store','TeacherContentController@store');
		Route::post('/teacher/content/info', 'TeacherContentController@info'); //ajax
		Route::get('/teacher/content/destroy/{id}','TeacherContentController@destroy');
		Route::get('/teacher/content/download/{id}', 'TeacherContentController@download');
		Route::controller('teacher/content','TeacherContentController');		

		Route::post('/teacher/proposed_homework/info', 'TeacherProposedHomeworkController@info'); //ajax
		Route::post('/teacher/proposed_homework/store','TeacherProposedHomeworkController@store');
		Route::get('/teacher/proposed_homework/download/{id}', 'TeacherProposedHomeworkController@download');
		Route::controller('teacher/proposed_homework','TeacherProposedHomeworkController');

		Route::post('/teacher/done_homework/evaluate/{id}','TeacherDoneHomeworkController@evaluate');
		Route::post('/teacher/done_homework/update/{id}','TeacherDoneHomeworkController@update');
		Route::get('/teacher/done_homework/download/{id}', 'TeacherDoneHomeworkController@download');
		Route::controller('teacher/done_homework','TeacherDoneHomeworkController');		

		Route::get('/teacher/score/download/{id_subject}', 'TeacherScoreController@download');
		Route::controller('teacher/score','TeacherScoreController');

		Route::post('teacher/account/update','TeacherAccountController@update');
		Route::controller('teacher/account','TeacherAccountController');
	});

	Route::group(array('before' => 'student'), function()
	{
		Route::get('student/index', function(){
			return View::make('student.index');
		});

		Route::post('/student/content/info', 'StudentContentController@info'); //ajax
		Route::get('/student/content/download/{id}', 'StudentContentController@download');
		Route::controller('student/content','StudentContentController');

		Route::get('/student/proposed_homework/download/{id}', 'StudentProposedHomeworkController@download');
		Route::post('/student/proposed_homework/info', 'StudentProposedHomeworkController@info'); //ajax
		Route::controller('student/proposed_homework','StudentProposedHomeworkController');

		Route::post('/student/done_homework/store/{id_user}/{id_proposed_homework}','StudentDoneHomeworkController@store');
		Route::controller('student/done_homework','StudentDoneHomeworkController');

		Route::get('/student/score/download','StudentScoreController@download');
		Route::controller('student/score','StudentScoreController');		

		Route::post('student/account/update','StudentAccountController@update');
		Route::controller('student/account','StudentAccountController');

	});

	Route::group(array('before' => 'coordinator'), function()
	{
		Route::get('coordinator/index', function(){
			return View::make('coordinator.index');
		});

		Route::post('/coordinator/score/info', 'CoordinatorScoreController@info'); //ajax
		Route::get('/coordinator/score/download/{id_grade}/{id_subject}', 'CoordinatorScoreController@download');
		Route::post('/coordinator/score/fill_subjects', 'CoordinatorScoreController@fill_subjects'); //ajax
		Route::controller('coordinator/score','CoordinatorScoreController');

		Route::post('coordinator/account/update','CoordinatorAccountController@update');
		Route::controller('coordinator/account','CoordinatorAccountController');		

	});	

});





