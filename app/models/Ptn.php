<?php

class Ptn extends Eloquent {

	protected $table = 'ptn';
	
	public function prodi()
	{
		return $this->hasMany('Prodi');
	}

	public function pilihan()
	{
		return $this->hasMany('Pilihan');
	}
	
}