<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposedHomeworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proposed_homeworks', function(Blueprint $table) {
			$table->create();
			
			$table->increments('id');
			$table->integer('id_subject')->unsigned();
			$table->foreign('id_subject')->references('id')->on('subjects');
			$table->string('name', 100);
			$table->string('route')->unique();
			$table->integer('weighing');
			$table->date('culmination_date');
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
		Schema::drop('proposed_homeworks');
	}

}
