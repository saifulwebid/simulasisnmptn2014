@extends('layouts.main')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Lihat Data Angkatan</h1>
			</div>
			<ul class="nav nav-tabs">
				<li{{ Route::currentRouteName() == 'filter.semester' ? ' class="active"' : ''}}>
					<a href="{{ URL::route('filter.semester') }}">Ranking Paralel</a>
				</li>
				<li{{ Route::currentRouteName() == 'filter.prodi' ? ' class="active"' : ''}}>
					<a href="{{ URL::route('filter.prodi') }}">Peminat Program Studi PTN</a>
				</li>
				<li{{ Request::is('filter/rekap*') ? ' class="active"' : ''}}>
					<a href="{{ URL::route('filter.rekap') }}">Grafik Peminat PTN</a>
				</li>
			</ul>
			@yield('inner-content')
		</div>
	</div>
	<style type="text/css">
	.nav-tabs {
		margin: 1em 0;
	}
	.panel-content {
		padding: 1em;
	}
	</style>
</div>
@stop