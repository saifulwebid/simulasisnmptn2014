@extends('layouts.main')

@section('title', 'Rekapitulasi Kelas')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					@yield('title')
					{{ $nama_kelas }}
				</h1>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h2 class="panel-title">Progress Kelas</h2>
				</div>
				<div class="panel-body">
					<p class="text-info pull-right" style="margin-left: 10px;">{{ number_format(( $count_verifikasi + $count_pilih ) / ( count($data) * 2 ) * 100, 1) }}%</p>
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="{{ $count_verifikasi }}" aria-valuemin="0" aria-valuemax="{{ count($data) }}" style="width: {{ $count_verifikasi / count($data) * 50 }}%">
							{{ $count_verifikasi }} siswa sudah verifikasi
						</div>
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $count_pilih }}" aria-valuemin="0" aria-valuemax="{{ count($data) }}" style="width: {{ $count_pilih / count($data) * 50 }}%">
							{{ $count_pilih }} siswa sudah memilih
						</div>
					</div>

				</div>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>NIS</th>
						<th>Nama Lengkap</th>
						<th>Verifikasi Nilai</th>
						<th>Pilihan PTN dan Program Studi</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $data as $siswa )
					<tr class="{{ ( ( $siswa->verifikasi == 1 ) && ( count($siswa->pilihan) > 0 ) ) ? 'success' : 'danger' }}">
						<td>{{ $siswa->nis }}</td>
						<td>{{ $siswa->nama }}</td>
						<td>
							@if ( $siswa->verifikasi == 0 )
							<span class="label label-warning">Belum verifikasi</span>
							@else
							<span class="label label-success">Sudah verifikasi</span>
							<a href="{{ URL::route('admin.batal', $siswa->id) }}" class="btn btn-xs btn-warning hidden-print">Batalkan</a>
							@endif
						</td>
						<td>
							@if ( count($siswa->pilihan) > 0 )
								@foreach ( $siswa->pilihan as $pilihan )
								{{ $pilihan->pilihan }}: {{ $pilihan->ptn->nama }} - {{ $pilihan->prodi->nama }}<br>
								@endforeach
							@else
								<span class="label label-warning">Belum memilih</span>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop