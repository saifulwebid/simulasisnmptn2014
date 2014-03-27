<?php

class AjaxController extends BaseController {

	public function getProdiByPTN()
	{
		$prodi = Ptn::find( Input::get('ptn') )->prodi;
		return $prodi->toArray();
	}

}