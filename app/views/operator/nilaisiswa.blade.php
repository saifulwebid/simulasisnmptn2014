@extends('layouts.main')

@section('title', 'Perbaiki Nilai Siswa')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					@yield('title')
				</h1>
			</div>
		</div>
		<div class="col-md-12">
			@if ( Session::has('success') )
			<div class="alert alert-success">
				Nilai telah berhasil dirubah.
			</div>
			@endif
			<table class="table table-striped table-bordered">
				<tr>
					<th>Nama Lengkap</th>
					<td>{{ $data->nama }}</td>
				</tr>
				<tr>
					<th>Kelas</th>
					<td>{{ $data->kelas->nama }}</td>
				</tr>
				<tr>
					<th>Tempat Lahir</th>
					<td>{{ $data->tempat_lahir }}</td>
				</tr>
				<tr>
					<th>Tanggal Lahir</th>
					<td>{{ $data->tanggal_lahir }}</td>
				</tr>
				<tr>
					<th>Sudah Diverifikasi?</th>
					<td>
						@if ( $data->verifikasi == 0 )
						<span class="label label-warning">Belum diverifikasi</span>
						@else
						<span class="label label-success">Sudah diverifikasi</span>
						@endif
					</td>
				</tr>
			</table>
			{{ Form::open() }}
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th>Mata Pelajaran</th>
						@foreach ( $data->nilai as $nilai )
						<th style="min-width: 80px">
							Smt. {{ $nilai->semester }}<br>
							{{ $nilai->kelas->nama }}
						</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach ( $pelajaran as $kode => $pel )
					<tr>
						<td>{{ $pel }}</td>
						@foreach ( $data->nilai as $nilai )
						<td>
							{{ Form::text('nilai[' . $nilai->id . '][' . $kode . ']', $nilai->$kode, array( 'class' => 'form-control') ) }}
						</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ Form::submit('Perbaiki Nilai ' . $data->nama, array('class' => 'btn btn-primary btn-block')) }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop