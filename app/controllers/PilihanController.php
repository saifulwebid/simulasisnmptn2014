<?php

class PilihanController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('verified');
	}

	public function getPilihanBySiswa( $id_siswa )
	{
		for ( $i = 1; $i <= 3; $i++ ) {
			$pilihan[$i]['pilihan'] = $i;
			try {
				$pilihan[$i]['data'] = Siswa::find($id_siswa)->pilihan()->where('pilihan', $i)->first();
				$pilihan[$i]['ptn'] = $pilihan[$i]['data']->ptn_id;
				$pilihan[$i]['prodi'] = $pilihan[$i]['data']->prodi_id;
			} catch ( Exception $e ) {
				$pilihan[$i] = array('data' => null, 'ptn' => null, 'prodi' => null);
			}
		}

		$ptn = Ptn::all();
		$dataptn['-'] = 'Pilih universitas...';
		foreach ( $ptn as $univ ) {
			$dataptn[ $univ->id ] = $univ->nama;
			
			$prodi = Ptn::find( $univ->id )->prodi;
			$dataprodi[ $univ->id ]['-'] = 'Pilih program studi...';
			foreach ( $prodi as $prodilisting ) {
				$dataprodi[ $univ->id ][ $prodilisting->id ] = $prodilisting->nama;
			}
		}

		return View::make('pilihan.single')
			->with('pilihan', $pilihan)
			->with('siswa', Siswa::find($id_siswa))
			->with('ptn', $dataptn)
			->with('prodi', $dataprodi);
	}

	public function postPilihanBySiswa( $id_siswa )
	{
		$data['ptn'] = Input::get('ptn');
		$data['prodi'] = Input::get('prodi');

		for ( $i = 1; $i <= 3; $i++ ) {

			$valid = (isset($data['prodi'][$i])) && ($data['prodi'][$i] !== "-") && ($data['ptn'][$i] !== "-");
			$pilihan = Siswa::find($id_siswa)->pilihan()->where('pilihan', $i)->first();

			if ( $valid ) {
				$new = false;

				if ( $pilihan == null ) {
					$new = true;
					$pilihan = New Pilihan;
					$pilihan->siswa_id = $id_siswa;
					$pilihan->pilihan = $i;
				}

				$pilihan->ptn_id = $data['ptn'][$i];
				$pilihan->prodi_id = $data['prodi'][$i];
				$pilihan->save();

				Log::info( ($new == true ? 'Chose' : 'Changed' ) . ' PTN.',
					array('pilihan' => $i, 'prodi' => $pilihan->prodi_id, 'nis' => Auth::user()->nis, 'nama' => Auth::user()->nama ));
			} else {
				if ( $pilihan !== null ) {
					Log::info('Deleted PTN.',
						array('pilihan' => $i, 'prodi' => $pilihan->prodi_id, 'nis' => Auth::user()->nis, 'nama' => Auth::user()->nama ));
					
					$pilihan->delete();
				}
			}
			
			unset($pilihan);

		}

		return Redirect::back()->with('success', 'Pilihan PTN Anda berhasil ditetapkan!');
	}

	public function getMyPilihan()
	{
		return $this->getPilihanBySiswa( Auth::user()->id );
	}

	public function postMyPilihan()
	{
		return $this->postPilihanBySiswa( Auth::user()->id );
	}

}