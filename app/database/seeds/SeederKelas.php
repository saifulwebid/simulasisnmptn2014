<?php

class SeederKelas extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('kelas')->delete();

		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X A'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X B'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X C'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X D'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X E'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X F'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X G'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X H'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X I'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X J'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X K'));
		Kelas::create(array('tingkat' => 1, 'jurusan' => 'umum', 'nama' => 'X Tambahan'));

		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 1'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 2'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 3'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 4'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 5'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 6'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 7'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 8'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA 9'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPS', 'nama' => 'XI IPS 1'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPS', 'nama' => 'XI IPS 2'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPA', 'nama' => 'XI IPA Tambahan'));
		Kelas::create(array('tingkat' => 2, 'jurusan' => 'IPS', 'nama' => 'XI IPS Tambahan'));

		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 1'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 2'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 3'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 4'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 5'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 6'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 7'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 8'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA 9'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPS', 'nama' => 'XII IPS 1'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPS', 'nama' => 'XII IPS 2'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPA', 'nama' => 'XII IPA Tambahan'));
		Kelas::create(array('tingkat' => 3, 'jurusan' => 'IPS', 'nama' => 'XII IPS Tambahan'));
	}

}