@extends('layouts.main')

@section('title', 'Reset Password Siswa')

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
			</table>
			@if ( Session::has('password') )
			<div class="well">
				<div class="row">
					<div class="col-md-6">
						<p align="center"><b>Username</b></p>
						<p align="center" style="font-size: 40px; font-style: monospace;">{{ $data->nis }}</p>
					</div>
					<div class="col-md-6">
						<p align="center"><b>Password</b></p>
						<p align="center" style="font-size: 40px; font-style: monospace;">{{ Session::get('password') }}</p>
					</div>
				</div>
			</div>
			@else
			{{ Form::open() }}
			<div class="well">
				<p align="center"><strong>Kamu yakin mau reset password {{ $data->nama }}?</strong></p>
				<div class="row">
					<div class="col-sm-6">
						{{ Form::submit('Ya, Reset !', array('class' => 'btn btn-primary btn-block')) }}
					</div>
					<div class="col-sm-6">
						<a href="{{ URL::route('operator.reset') }}" class="btn btn-danger btn-block">Batalkan!</a>
					</div>
				</div>
			</div>
			{{ Form::close() }}
			@endif
		</div>
	</div>
</div>
@stop