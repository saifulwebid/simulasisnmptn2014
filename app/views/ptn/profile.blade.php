@extends('layouts.main')

@section('title', 'Daftar Program Studi di ' . $ptn->nama)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>@yield('title')</h1>
			</div>
			@foreach ( $prodi as $jurusan )
			<li>{{ $jurusan->nama }} untuk jurusan {{ $jurusan->bidang }}</li>
			@endforeach
		</div>
	</div>
</div>
@stop