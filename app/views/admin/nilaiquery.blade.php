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
			{{ Form::open() }}
			<div class="well">
				<p align="center"><strong>Masukkan NIS dari siswa yang mau dirubah nilainya:</strong></p>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						{{ Form::text('nis', null, array('class' => 'form-control input-lg')) }}
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						{{ Form::submit('Lakukan Perubahan Nilai', array('class' => 'btn btn-primary btn-block')) }}
					</div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop