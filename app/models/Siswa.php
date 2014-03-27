<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Siswa extends Eloquent implements UserInterface, RemindableInterface {

	protected $table = 'siswa';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		// return $this->email;
		return null;
	}

	public function kelas()
	{
		return $this->belongsTo('Kelas');
	}

	public function nilai()
	{
		return $this->hasMany('Nilai');
	}

	public function pilihan()
	{
		return $this->hasMany('Pilihan');
	}

	public function testimoni()
	{
		return $this->hasOne('Testimoni');
	}

}