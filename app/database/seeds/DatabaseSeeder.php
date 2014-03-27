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

		$this->command->info('Memasukkan data kelas...');
		$this->call('SeederKelas');
		$this->command->info('Data kelas sudah dimasukkan!');

		$this->command->info('Memasukkan data siswa...');
		$this->call('SeederSiswa');
		$this->command->info('Data siswa sudah dimasukkan!');

		$this->command->info('Memasukkan data sampel nilai...');
		$this->call('SeederNilai');
		$this->command->info('Data sampel nilai sudah dimasukkan!');

		$this->command->info('Memasukkan data PTN dan data program studi...');
		$this->call('SeederPTN');
		$this->command->info('Data PTN dan data program studi sudah dimasukkan!');

		$this->command->info('Memasukkan data sampel pilihan PTN...');
		$this->call('SeederPilihan');
		$this->command->info('Data sampel pilihan PTN sudah dimasukkan!');
	}

}