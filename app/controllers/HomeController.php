<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		if ( Auth::check() ) {
			return View::make('index-user');
		} else {
			return View::make('index-biasa');
		}
	}

	public function postIndex()
	{
		if ( Auth::user()->testimoni !== null )
			Auth::user()->testimoni->delete();

		$testimoni = new Testimoni;
		$testimoni->testimoni = Input::get('testimoni');
		$testimoni->siswa()->associate( Auth::user() );
		$testimoni->save();

		return Redirect::to( URL::previous() . '#thanks_testimoni')->with('thanks_testimoni', true);
	}

}