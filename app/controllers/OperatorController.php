<?php

class OperatorController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('operatorOnly');
	}

	public function getRekapKelas()
	{
		$data = Siswa::where( 'kelas_id', Auth::user()->kelas->id )
						->with('pilihan', 'pilihan.prodi', 'pilihan.ptn')
						->get();
		
		$count_verifikasi = 0;
		$count_pilih = 0;
		foreach ( $data as $siswa ) {
			if ( $siswa->verifikasi == 1 ) $count_verifikasi++;
			if ( count($siswa->pilihan) > 0 ) $count_pilih++;
		}

		return View::make('operator.rekap')
						->with('data', $data)
						->with('count_verifikasi', $count_verifikasi)
						->with('count_pilih', $count_pilih);
	}

	public function getNilaiKelas()
	{
		$data = Siswa::where( 'kelas_id', Auth::user()->kelas->id )->get();

		return View::make('operator.nilai')->with('data', $data);
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

		return View::make('operator.nilaisiswa')->with('data', $data)->with('pelajaran', $pelajaran);
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

		Log::info('Perubahan nilai oleh operator.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $siswa->nama ));

		return Redirect::back()->with('success', true);
	}

	public function getResetPassword()
	{
		$data = Siswa::where( 'kelas_id', Auth::user()->kelas->id )->get();

		return View::make('operator.reset')->with('data', $data);
	}

	public function getResetPasswordSiswa( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );

		return View::make('operator.resetsiswa')->with('data', $data);
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

		Log::info('Reset password oleh operator. NIS: ' . $data->nis . ', Password: ' . $newPassword . '.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $data->nama ));

		return Redirect::back()->with('data', $data)->with('password', $newPassword);
	}

	public function getBatalkanVerifikasi( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );

		return View::make('operator.batal')->with('data', $data);
	}

	public function postBatalkanVerifikasi( $id_siswa )
	{
		$data = Siswa::find( $id_siswa );
		$data->verifikasi = 0;
		$data->save();

		Log::info('Verifikasi dibatalkan oleh operator.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama, 'to' => $data->nama ));

		return Redirect::back()->with('data', $data)->with('success', true);
	}

}