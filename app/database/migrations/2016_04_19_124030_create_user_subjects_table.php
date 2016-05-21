<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_subjects', function(Blueprint $table) {
			
			$table->create();
			$table->increments('id');
			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('users');
			$table->integer('id_subject')->unsigned();
			$table->foreign('id_subject')->references('id')->on('subjects');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_subjects');
	}

}
