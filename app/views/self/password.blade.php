@extends('layouts.main')

@section('title', 'Ganti Password')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>@yield('title')</h1>
			</div>
			@if ( Session::has('success') )
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Password Anda berhasil diganti.
			</div>
			@endif
			@if ( Session::has('wrong') )
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Password lama Anda salah. Coba lagi.
			</div>
			@endif
			@if ( $errors->has('password') )
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Password baru tidak sama dengan konfirmasinya. Coba lagi.
			</div>
			@endif
			{{ Form::open( array( 'route' => 'self.password', 'class' => 'form-horizontal' ) ) }}
			<div class="form-group">
				{{ Form::label('old_password', 'Password saat ini', array( 'class' => 'control-label col-md-3' ) ) }}
				<div class="col-md-9">
					{{ Form::password('old_password', array( 'class' => 'form-control', 'placeholder' => 'Password saat ini...') ) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('password', 'Password baru', array( 'class' => 'control-label col-md-3' ) ) }}
				<div class="col-md-9">
					{{ Form::password('password', array( 'class' => 'form-control', 'placeholder' => 'Password baru...') ) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('password_confirmation', 'Ulangi password baru', array( 'class' => 'control-label col-md-3' ) ) }}
				<div class="col-md-9">
					{{ Form::password('password_confirmation', array( 'class' => 'form-control', 'placeholder' => 'Ulangi password baru...') ) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-9">
					{{ Form::submit('Ganti password', array( 'class' => 'btn btn-primary' )) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop