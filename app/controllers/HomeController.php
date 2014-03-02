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

}