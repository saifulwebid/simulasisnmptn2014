<?php

class UserController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth', array('except' => array('getLogin', 'postLogin', 'getLogout')));
	}


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
			Log::info('Log in success.',
				array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama ));

			return Redirect::intended('/');
		} else {
			Log::notice('Failed log in attempt!',
				array('user' => Input::get('nis'), 'password' => Input::get('password')));

			return Redirect::route('auth.login')->withInput()->with( array('login-error' => true) );
		}
	}

	public function getLogout()
	{
		if ( Auth::check() )
			Log::info('Log out.', array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama ));

		Auth::logout();

		return Redirect::intended('/');
	}

	public function getChangePassword()
	{
		return View::make('self.password');
	}

	public function postChangePassword()
	{
		$validator = Validator::make( Input::all(), array('password' => 'confirmed') );

		if ( $validator->fails() ) {
			return Redirect::back()->withErrors($validator);
		}

		$user = Auth::user();
		if ( !Hash::check( Input::get('old_password'), $user->password ) ) {
			Log::notice('Failed to change pwd, old pwd mismatch.',
				array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'old_pwd' => Input::get('old_password') ));

			return Redirect::back()->with('wrong', true);
		}

		$user->password = Hash::make( Input::get('password') );
		$user->save();

		Log::info('Changed password.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'pwd' => Input::get('password') ));

		return Redirect::back()->with('success', true);
	}

}