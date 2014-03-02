<?php

class AuthController extends BaseController {

	public function getLogin()
	{
		return View::make('login');
	}

	public function postLogin()
	{
		$nis      = Input::get('nis');
		$password = Input::get('password');
		$remember = Input::get('remember', false);

		if ( Auth::attempt( array( 'nis' => $nis, 'password' => $password ), $remember ) ) {
			return Redirect::intended('/');
		} else {
			return Redirect::route('auth.login')->withInput()->with( array('login-error' => true) );
		}
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::intended('/');
	}

}