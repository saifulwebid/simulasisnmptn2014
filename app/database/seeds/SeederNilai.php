<?php

class SeederNilai extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('nilai')->delete();
	}

}