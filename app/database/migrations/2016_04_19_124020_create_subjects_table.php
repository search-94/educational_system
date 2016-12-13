<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subjects', function(Blueprint $table){
			
			$table->create();
			$table->increments('id');
			$table->string('name', 50);
			$table->integer('id_grade')->unsigned();
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
		Schema::drop('subjects');
	}

}
