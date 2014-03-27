<?php

class AdminController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('adminOnly');
	}

	public function getRekapUmum()
	{
		$data = Kelas::whereTingkat(3)
						->with('siswa', 'siswa.pilihan')
						->get()
						->filter( function($kelas) {
							if ( count($kelas->siswa) > 0 ) return true;
						});

		$total['siswa'] = 0;
		$total['verifikasi'] = 0;
		$total['pilih'] = 0;

		foreach ( $data as $kelas )
		{
			$count_verifikasi[ $kelas->id ] = 0;
			$count_pilih[ $kelas->id ] = 0;

			foreach ( $kelas->siswa as $siswa )
			{
				$total['siswa']++;

				if ( $siswa->verifikasi == 1 ) {
					$count_verifikasi[ $kelas->id ]++;
					$total['verifikasi']++;
				}

				if ( count($siswa->pilihan) > 0 ) {
					$count_pilih[ $kelas->id ]++;
					$total['pilih']++;
				}
			}
		}

		return View::make('admin.rekap')
						->with('data', $data)
						->with('count_verifikasi', $count_verifikasi)
						->with('count_pilih', $count_pilih)
						->with('total', $total);
	}

	public function getRekapKelas( $id_kelas )
	{
		$data = Siswa::where( 'kelas_id', $id_kelas )
						->with('pilihan', 'pilihan.prodi', 'pilihan.ptn')
						->get();
		
		$count_verifikasi = 0;
		$count_pilih = 0;
		foreach ( $data as $siswa ) {
			if ( $siswa->verifikasi == 1 ) $count_verifikasi++;
			if ( count($siswa->pilihan) > 0 ) $count_pilih++;
		}

		return View::make('admin.kelas')
						->with('data', $data)
						->with('count_verifikasi', $count_verifikasi)
						->with('count_pilih', $count_pilih)
						->with('nama_kelas', Kelas::find( $id_kelas )->nama);
	}

	public function getNilaiMenu()
	{
		return View::make('admin.nilaiquery');
	}

	public function postNilaiMenu()
	{
		$siswa = Siswa::where('nis', Input::get('nis'))->first();

		return Redirect::route('admin.nilaisiswa', $siswa->id);
	}

	public function getNilaiSiswa( $id_siswa )
	{
		$pelajaran = array(
			'AGM' => 'Pendidikan Agama',
			'KWN' => 'Pendidikan Kewarganegaraan',
			'IND' => 'Bahasa Indonesia',
			'ING' => 'Bahasa Inggris',
			'MAT' => 'Matematika',
			'FIS' => 'Fisika',
			'KIM' => 'Kimia',
			'BIO' => 'Biologi',
			'SJR' => 'Sejarah',
			'GEO' => 'Geografi',
			'EKO' => 'Ekonomi',
			'SOS' => 'Sosiologi',
			'SNB' => 'Seni Budaya',
			'PJO' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
			'TIK' => 'Teknologi Informasi dan Komunikasi',
			'KBA' => 'Keterampilan/Bahasa Asing'
		);

		$data = Siswa::with('nilai', 'nilai.kelas')->find( $id_siswa );

		return View::make('admin.nilaisiswa')->with('data', $data)->with('pelajaran', $pelajaran);
	}

	public function postNilaiSiswa( $id_siswa )
	{
		$pelajaran = array(
			'AGM' => 'Pendidikan Agama',
			'KWN' => 'Pendidikan Kewarganegaraan',
			'IND' => 'Bahasa Indonesia',
			'ING' => 'Bahasa Inggris',
			'MAT' => 'Matematika',
			'FIS' => 'Fisika',
			'KIM' => 'Kimia',
			'BIO' => 'Biologi',
			'SJR' => 'Sejarah',
			'GEO' => 'Geografi',
			'EKO' => 'Ekonomi',
			'SOS' => 'Sosiologi',
			'SNB' => 'Seni Budaya',
			'PJO' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
			'TIK' => 'Teknologi Informasi dan Komunikasi',
			'KBA' => 'Keterampilan/Bahasa Asing'
		);

		$input = Input::get('nilai');
		$siswa = Siswa::find( $id_siswa );

		foreach ( $input as $id => $nilai ) {
			if ( $siswa->nilai->contains( $id ) ) {
				$data = $siswa->nilai->find( $id );

				foreach ( $pelajaran as $keyPel => $valuePel ) {
					$data->$keyPel = $nilai[$keyPel];
				}

				$data->save();
			}
		}

		Log::info('Perubahan nilai oleh admin.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $siswa->nama ));

		return Redirect::back()->with('success', true);
	}

	public function getResetPassword()
	{
		return View::make('admin.resetquery');
	}

	public function postResetPassword()
	{
		$siswa = Siswa::where('nis', Input::get('nis'))->first();

		return Redirect::route('admin.resetsiswa', $siswa->id);
	}

	public function getResetPasswordSiswa( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );

		return View::make('admin.resetsiswa')->with('data', $data);
	}

	public function postResetPasswordSiswa( $id_siswa )
	{
		$newPassword = '';
		for ( $i = 0; $i < 8; $i++ ) {
			$newPassword .= (string) mt_rand(0, 9);
		}

		$data = Siswa::find( $id_siswa );
		$data->password = Hash::make( $newPassword );
		$data->save();

		Log::info('Reset password oleh admin. NIS: ' . $data->nis . ', Password: ' . $newPassword . '.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $data->nama ));

		return Redirect::back()->with('data', $data)->with('password', $newPassword);
	}

	public function getBatalkanVerifikasi( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );

		return View::make('admin.batal')->with('data', $data);
	}

	public function postBatalkanVerifikasi( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );
		$data->verifikasi = 0;
		$data->save();

		Log::info('Verifikasi dibatalkan oleh admin.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $data->nama ));

		return Redirect::back()->with('data', $data)->with('success', true);
	}

	public function getLog()
	{
		$log = file_get_contents( storage_path() . '/logs/laravel.log' );

		return View::make('admin.log')->with('log', explode("\n", $log));
	}

}