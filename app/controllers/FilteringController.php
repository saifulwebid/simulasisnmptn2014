<?php

class FilteringController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('verified');
		$this->beforeFilter('pilihDulu');
	}

	private function sort_FBR( $jenis ) {
		return function ($a, $b) use ($jenis) {
			if ( $a->$jenis == $b->$jenis ) return 0;
			return ( $a->$jenis > $b->$jenis ) ? -1 : 1;
		};
	}

	private function getRanking() {

		$datasiswa = Siswa::with(array('kelas', 'pilihan', 'pilihan.ptn', 'pilihan.prodi'))->get();
		$pelajaran = array('IND', 'ING', 'MAT', 'FIS', 'KIM', 'BIO', 'GEO', 'EKO', 'SOS');
		$jurusan = array('IPA', 'IPS');

		foreach ( $datasiswa as $siswa ) {

			$buffer = new StdClass;
			$buffer->id = $siswa->id;
			$buffer->nama = $siswa->nama;
			$buffer->kelas = $siswa->kelas->nama;
			$buffer->pilihan = $siswa->pilihan;
			$buffer->verifikasi = $siswa->verifikasi;
			$buffer->prodi = array();

			foreach ( $pelajaran as $key ) {
				$rataan[$key] = 0;
			}

			foreach ( $siswa->nilai as $nilai ) {
				foreach ( $pelajaran as $key ) {
					$rataan[$key] += $nilai->$key;
				}
			}

			foreach ( $rataan as $key => $value ) {
				$rataan[$key] = $value / count($siswa->nilai);
			}

			$buffer->IPA = ($rataan['IND'] + $rataan['ING'] + $rataan['MAT'] + $rataan['FIS'] + $rataan['KIM'] + $rataan['BIO']) / 6;
			$buffer->IPS = ($rataan['IND'] + $rataan['ING'] + $rataan['MAT'] + $rataan['GEO'] + $rataan['EKO'] + $rataan['SOS']) / 6;

			$buffer->rank = new StdClass;

			$data[] = $buffer;
			unset($buffer);

		}

		foreach ( $jurusan as $jurusansingle ) {

			usort ( $data, $this->sort_FBR( $jurusansingle ) );

			$rank = 0;
			$list = 0;
			$last = 0;

			foreach ( $data as $buffer ) {

				$list++;
				if ( $buffer->$jurusansingle !== $last ) $rank = $list;

				$buffer->rank->$jurusansingle = $rank;
				$last = $buffer->$jurusansingle;

			}

		}

		return $data;

	}

	public function getMainMenu()
	{
		return View::make('filter.menu');
	}

	public function getFilterByRanking()
	{

		$data = $this->getRanking();

		usort( $data, $this->sort_FBR( Auth::user()->kelas->jurusan ) );

		return View::make('filter.semester')->with('data', $data)->with('self_id', Auth::user()->id);

	}

	public function getFilterByProdi()
	{
		$valid = Input::has('ptn') && Input::has('prodi');// && ( Input::get('prodi') !== '-');
		$view = View::make('filter.prodi');

		$ptn = Ptn::all();
		$dataptn['-'] = 'Pilih universitas...';
		foreach ( $ptn as $univ ) {
			$dataptn[ $univ->id ] = $univ->nama;
			
			if ( $valid && $univ->id == Input::get('ptn') ) {
				$prodi = Ptn::find( $univ->id )->prodi;
				$dataprodi[ $univ->id ]['-'] = 'Semua program studi';
				foreach ( $prodi as $prodilisting ) {
					$dataprodi[ $univ->id ][ $prodilisting->id ] = $prodilisting->nama;
				}
			}
		}

		$data = array();

		if ( $valid ) {
		
			$ranking = $this->getRanking();

			if ( Input::get('prodi') !== '-' ) {
				usort( $ranking, $this->sort_FBR( Prodi::find( Input::get('prodi') )->bidang ) );
			} else {
				usort( $ranking, $this->sort_FBR( Auth::user()->kelas->jurusan ) );
			}

			foreach ( $ranking as $entry ) {
				foreach ( $entry->pilihan as $pilihan ) {
					if ( Input::get('prodi') !== '-' ) {
						$view = $view->with('cur_prodi', Prodi::find( Input::get('prodi') ));

						if ( $pilihan->prodi->id == Input::get('prodi') ) {
							$data[] = array('entry' => $entry, 'pilihan' => $pilihan->pilihan, 'bidang' => $pilihan->prodi->bidang, 'prodi' => $pilihan->prodi);
						}
					} else {
						$view = $view->with('cur_ptn', Ptn::find( Input::get('ptn') ));

						if ( $pilihan->ptn->id == Input::get('ptn') ) {
							$data[] = array('entry' => $entry, 'pilihan' => $pilihan->pilihan, 'bidang' => $pilihan->prodi->bidang, 'prodi' => $pilihan->prodi);
						}
					}
				}
			}

		}

		$view = $view->with('ptn', $dataptn)->with('self_id', Auth::user()->id);
		
		if ( $valid )
			return $view->with('prodi', $dataprodi)->with('data', $data);

		return $view;
	}

	public function getRekapitulasi()
	{
		$rekap = DB::select('SELECT * FROM (SELECT ptn.*,
				( SELECT count(*) from pilihan WHERE pilihan.ptn_id = ptn.id AND pilihan.pilihan = 1 ) as pil_1,
				( SELECT count(*) from pilihan WHERE pilihan.ptn_id = ptn.id AND pilihan.pilihan = 2 ) as pil_2,
				( SELECT count(*) from pilihan WHERE pilihan.ptn_id = ptn.id AND pilihan.pilihan = 3 ) as pil_3
				FROM ptn) a WHERE a.pil_1 > 0 or a.pil_2 > 0 or a.pil_3 > 0');

		return View::make('filter.rekap')->with('rekap', $rekap);
	}

	public function getRekapPtn( $id_ptn )
	{
		$rekap = DB::select('SELECT * FROM (SELECT prodi.*,
				( SELECT count(*) from pilihan WHERE pilihan.prodi_id = prodi.id AND pilihan.pilihan = 1 ) as pil_1,
				( SELECT count(*) from pilihan WHERE pilihan.prodi_id = prodi.id AND pilihan.pilihan = 2 ) as pil_2,
				( SELECT count(*) from pilihan WHERE pilihan.prodi_id = prodi.id AND pilihan.pilihan = 3 ) as pil_3
				FROM prodi WHERE prodi.ptn_id = ?) a WHERE a.pil_1 > 0 or a.pil_2 > 0 or a.pil_3 > 0',
				array( $id_ptn ));

		return View::make('filter.rekapptn')->with('rekap', $rekap)->with('ptn', Ptn::find( $id_ptn ));
	}

}