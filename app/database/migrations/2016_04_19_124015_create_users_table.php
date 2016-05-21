<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {



	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table){
			
			$table->create();
			$table->increments('id');
			$table->string('identity_card');
			$table->string('password');
			$table->string('first_name');
			$table->string('second_name');
			$table->integer('id_role')->unsigned();
			$table->foreign('id_role')->references('id')->on('roles');
			$table->integer('id_grade')->unsigned()->nullable();
			$table->foreign('id_grade')->references('id')->on('grades');
			$table->timestamps();
			$table->softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
