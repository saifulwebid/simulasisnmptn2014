<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kelas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tingkat');
			$table->enum('jurusan', array('umum', 'IPA', 'IPS'));
			$table->string('nama', 30);
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
		Schema::drop('kelas');
	}

}
