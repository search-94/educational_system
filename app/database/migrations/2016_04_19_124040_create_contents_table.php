<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contents', function(Blueprint $table) {
			
			$table->create();
			$table->increments('id');
			$table->integer('id_subject')->unsigned();
			$table->foreign('id_subject')->references('id')->on('subjects');
			$table->string('name');
			$table->string('route')->unique();
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
		Schema::drop('contents');
	}

}
