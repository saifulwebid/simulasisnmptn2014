@extends('layouts.main')

@section('title', 'Batalkan Verifikasi')

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
				Verifikasi nilai atas nama {{ $data->nama }} berhasil dibatalkan.
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
			@if ( $data->verifikasi == 1 )
			{{ Form::open() }}
			<div class="well">
				<p align="center"><strong>Kamu yakin mau membatalkan verifikasi {{ $data->nama }}?</strong></p>
				<div class="row">
					<div class="col-sm-6">
						{{ Form::submit('Lakukan Pembatalan Verifikasi', array('class' => 'btn btn-primary btn-block')) }}
					</div>
					<div class="col-sm-6">
						<a href="{{ URL::route('operator.rekap') }}" class="btn btn-danger btn-block">Tidak jadi</a>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			@endif
		</div>
	</div>
</div>
@stop