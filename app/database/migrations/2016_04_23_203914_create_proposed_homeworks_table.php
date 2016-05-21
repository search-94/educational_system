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
			$table->integer('id_period')->unsigned();
			$table->foreign('id_period')->references('id')->on('periods');	
			$table->string('name');
			$table->string('route')->unique();
			$table->boolean('is_active');
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
