<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class CreatePeriodsTable extends Migration {

	protected $dates = ['deleted_at'];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('periods', function(Blueprint $table) {
			
			$table->create();
			$table->increments('id');
			$table->integer('year');
			$table->integer('lapse');
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
		Schema::drop('periods');
	}

}
