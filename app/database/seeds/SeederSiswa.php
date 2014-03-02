<?php

class SeederSiswa extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('siswa')->delete();

		Siswa::create(array(
			'nis' => '111210380',
			'nisn' => null,
			'password' => Hash::make('muhammad'),
			'nama' => 'Muhammad Saiful Islam',
			'kelas' => 1,
			'role' => 'admin'
		));
	}

}