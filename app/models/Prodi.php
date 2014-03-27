<?php

class Prodi extends Eloquent {

	protected $table = 'prodi';

	public function ptn()
	{
		return $this->belongsTo('Ptn');
	}

	public function pilihan()
	{
		return $this->hasMany('Pilihan');
	}
	
}