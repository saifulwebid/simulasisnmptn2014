@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-push-4">
			<div class="page-header">
				<h1>Login</h1>
			</div>
			@if ( Session::has('login-error') )
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Aw!</strong> NIS/NISN atau password yang kamu masukkan salah. Coba lagi.
			</div>
			@endif
			{{ Form::open( array( 'route' => 'auth.login' ) ) }}
			<div class="form-group{{ Session::has('login-error') ? ' has-error' : '' }}">
				{{ Form::label('nis', 'Nomor Induk Siswa', array( 'class' => 'control-label' )) }}
				{{ Form::text('nis', null, array( 'class' => 'form-control', 'placeholder' => 'Nomor Induk Siswa...', 'autofocus') ) }}
			</div>
			<div class="form-group{{ Session::has('login-error') ? ' has-error' : '' }}">
				{{ Form::label('password', 'Password', array( 'class' => 'control-label' ) ) }}
				{{ Form::password('password', array( 'class' => 'form-control', 'placeholder' => 'Password...') ) }}
			</div>
			<div class="checkbox">
				<label>
					{{ Form::checkbox('remember') }} Ingat saya di perangkat ini
				</label>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">Login</button>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop