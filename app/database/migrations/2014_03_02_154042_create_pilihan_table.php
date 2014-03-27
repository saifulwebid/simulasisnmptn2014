<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilihanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pilihan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('siswa_id');
			$table->integer('pilihan');
			$table->integer('ptn_id');
			$table->integer('prodi_id');
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
		Schema::drop('pilihan');
	}

}
