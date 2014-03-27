<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prodi', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ptn_id');
			$table->string('nama', 150);
			$table->enum('bidang', array('IPA', 'IPS'));
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
		Schema::drop('prodi');
	}

}
