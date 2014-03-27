<?php

class Pilihan extends Eloquent {

	protected $table = 'pilihan';
	
	public function prodi()
	{
		return $this->belongsTo('Prodi');
	}

	public function ptn()
	{
		return $this->belongsTo('Ptn');
	}

	public function siswa()
	{
		return $this->belongsTo('Siswa');
	}

}