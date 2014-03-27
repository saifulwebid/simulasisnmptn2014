<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNilaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nilai', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('siswa_id');
			$table->integer('kelas_id');
			$table->integer('semester');
			$table->enum('jurusan', array('umum', 'IPA', 'IPS'));
			$table->integer('AGM')->default(0);
			$table->integer('KWN')->default(0);
			$table->integer('IND')->default(0);
			$table->integer('ING')->default(0);
			$table->integer('MAT')->default(0);
			$table->integer('FIS')->default(0);
			$table->integer('KIM')->default(0);
			$table->integer('BIO')->default(0);
			$table->integer('SJR')->default(0);
			$table->integer('GEO')->default(0);
			$table->integer('EKO')->default(0);
			$table->integer('SOS')->default(0);
			$table->integer('SNB')->default(0);
			$table->integer('PJO')->default(0);
			$table->integer('TIK')->default(0);
			$table->integer('KBA')->default(0);
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
		Schema::drop('nilai');
	}

}
