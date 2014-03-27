<?php

class NilaiController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('auth');
	}

	public function getNilaiByPerson( $id_siswa )
	{
		$data = Siswa::find( $id_siswa )->nilai;
		for ( $i = 1; $i <= 5; $i++ ) {
			try {
				$nilai[$i] = $data->where('semester', $i)->firstOrFail();
			} catch ( Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
				$nilai[$i] = null;
			}
		}
	}

	public function getNilaiByClass( $id_kelas, $id_semester )
	{
		foreach ( Kelas::find( $id_kelas )->siswa as $siswa ) {
			foreach ( $siswa->nilai as $nilai ) {
				
			}
		}
	}

	public function getInputNilaiByClass( $id_kelas, $id_semester )
	{

	}

	public function postInputNilaiByClass( $id_kelas, $id_semester )
	{

	}

	public function getVerifikasiNilai( $id_siswa )
	{
		
	}

	public function getInputVerifikasiNilai( $id_siswa )
	{

	}

	public function postVerifikasiNilai( $id_siswa )
	{

	}

	public function getVerifyNilai()
	{
		for ( $i = 1; $i <= 5; $i++ ) {
			$semester[$i]['semester'] = $i;
			try {
				$semester[$i]['data'] = Auth::user()->nilai()->where('semester', $i)->first();
			} catch ( Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
				$semester[$i] = null;
			}
		}

		$rataan = DB::table('nilai')
					->select( DB::raw(
						'avg(AGM) as AGM, avg(KWN) as KWN, avg(IND) as IND, avg(ING) as ING,
						 avg(MAT) as MAT, avg(FIS) as FIS, avg(KIM) as KIM, avg(BIO) as BIO,
						 avg(SJR) as SJR, avg(GEO) as GEO, avg(EKO) as EKO, avg(SOS) as SOS,
						 avg(SNB) as SNB, avg(PJO) as PJO, avg(TIK) as TIK, avg(KBA) as KBA'))
					->where('siswa_id', Auth::user()->id)
					->first();

		$rataan_basic = $rataan->IND + $rataan->ING + $rataan->MAT;
		$rataan_IPA = ( $rataan_basic + $rataan->FIS + $rataan->KIM + $rataan->BIO ) / 6;
		$rataan_IPS = ( $rataan_basic + $rataan->GEO + $rataan->EKO + $rataan->SOS ) / 6;

		$operatorQuery = Siswa::where( 'kelas_id', Auth::user()->kelas_id )
							->where( function($query) {
								$query->where('role', 'operator')->orWhere('role', 'admin');
							});
		if ( $operatorQuery->count() > 0 ) {
			$operator = $operatorQuery->with('kelas')->first();
		} else {
			$operator = Siswa::where('nis', '111210380')->with('kelas')->first();
		}

		return View::make('self.verify')
					->with('semester', $semester)
					->with('rataan', $rataan)
					->with('rataan_ipa', $rataan_IPA)
					->with('rataan_ips', $rataan_IPS)
					->with('operator', $operator);
	}

	public function postVerifyNilai()
	{
		$siswa = Auth::user();
		$siswa->verifikasi = true;
		$siswa->save();

		Log::info('Grade verified.',
			array('nis' => Auth::user()->nis, 'nama' => Auth::user()->nama ));

		return Redirect::back();
	}
}