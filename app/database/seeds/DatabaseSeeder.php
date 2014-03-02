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

		$this->call('SeederSiswa');
		$this->command->info('Data sampel siswa sudah dimasukkan!');
	}

}