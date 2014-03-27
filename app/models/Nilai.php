<?php

class Nilai extends Eloquent {

	protected $table = 'nilai';

	public function siswa()
	{
		return $this->belongsTo('Siswa');
	}

	public function kelas()
	{
		return $this->belongsTo('Kelas');
	}
	
}