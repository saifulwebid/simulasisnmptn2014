@extends('layouts.main')

@section('title', 'Unauthorized Access')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 unauthorized">
			<h1>Maaf, Anda tidak berhak.</h1>
			<p>Anda tidak berhak untuk mengakses halaman ini.</p>
			<p>Anda mungkin ingin <a href="{{ URL::to('/') }}" class="btn btn-default">kembali ke halaman depan</a>.</p>
		</div>
	</div>
</div>
@stop