<?php

class Kelas extends Eloquent {

	protected $table = 'kelas';

	public function siswa()
	{
		return $this->hasMany('Siswa');
	}
	
}