<?php

class PtnController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('adminOnly');
	}

	public function getListOfPTN()
	{
		$ptn = Ptn::all();
		return View::make('ptn.index')->with('ptn', $ptn);
	}

	public function getPTN( $id_ptn )
	{
		$ptn = Ptn::find($id_ptn);
		$prodi = $ptn->prodi;
		return View::make('ptn.profile')->with('ptn', $ptn)->with('prodi', $prodi);
	}

}