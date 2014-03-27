<?php

class Testimoni extends Eloquent {

	protected $table = 'testimoni';

	public function siswa()
	{
		return $this->belongsTo('Siswa');
	}
	
}