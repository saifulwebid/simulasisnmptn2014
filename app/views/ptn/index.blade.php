@extends('layouts.main')

@section('title', 'Daftar PTN Peserta SNMPTN 2014')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>@yield('title')</h1>
			</div>
			@foreach ( $ptn as $univ )
			<li><a href="{{ URL::route('ptn.profile', array('id_ptn' => $univ->id)) }}">{{ $univ->nama }}</a></li>
			@endforeach
		</div>
	</div>
</div>
@stop