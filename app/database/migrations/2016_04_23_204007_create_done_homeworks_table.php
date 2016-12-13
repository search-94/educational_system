<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneHomeworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('done_homeworks', function(Blueprint $table) {
			
			$table->create();
			$table->increments('id');
			$table->integer('id_proposed_homework')->unsigned();
			$table->foreign('id_proposed_homework')->references('id')->on('proposed_homeworks');
			$table->integer('id_user')->unsigned();
			$table->foreign('id_user')->references('id')->on('users');
			$table->string('route')->unique;
			$table->integer('score')->nullable();		
			$table->string('observations')->nullable();
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
		Schema::drop('done_homeworks');
	}

}
