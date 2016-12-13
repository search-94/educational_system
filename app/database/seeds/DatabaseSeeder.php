<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PeriodTableSeeder');
		$this->call('RoleTableSeeder');
		$this->call('GradeTableSeeder');
		$this->call('GenderTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('SubjectTableSeeder');
		$this->call('UserSubjectTableSeeder');
	}

}
