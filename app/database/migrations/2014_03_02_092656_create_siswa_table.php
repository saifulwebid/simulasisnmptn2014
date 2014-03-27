<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siswa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nis', 9);
			$table->string('nisn', 10)->nullable();
			$table->string('password', 60);
			$table->string('nama', 100);
			$table->integer('kelas_id')->nullable();;
			$table->enum('role', array('admin', 'operator', 'user'))->default('user');
			$table->string('tempat_lahir', 50);
			$table->date('tanggal_lahir')->default('1996-01-01');
			$table->boolean('verifikasi');
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
		Schema::drop('siswa');
	}

}
