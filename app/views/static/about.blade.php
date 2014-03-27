@extends('layouts.main')

@section('title', 'Tim Sistem Simulasi SNMPTN 2014')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>@yield('title')</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/saiful.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Muhammad Saiful Islam</h2>
					<h3>Developer &amp; DBA</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro XII, Student IT Community</p>
					<p><span class="glyphicon glyphicon-info-sign"></span> XII IPA&ndash;6</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/matias.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Matias Alvin Setianto</h2>
					<h3>Data Entry</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro XII, Student IT Community</p>
					<p><span class="glyphicon glyphicon-info-sign"></span> XII IPA&ndash;8</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/kharis.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Kharis Isriyanto</h2>
					<h3>Data Entry</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro XII, Student IT Community</p>
					<p><span class="glyphicon glyphicon-info-sign"></span> XII IPA&ndash;6</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/ari.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Arinurasti Rahma Lestari</h2>
					<h3>Data Entry</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro XII, Student IT Community</p>
					<p><span class="glyphicon glyphicon-info-sign"></span> XII IPA&ndash;8</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/rizki.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Rizki Ahmad Riyanto</h2>
					<h3>Data Entry</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro X, Student IT Community</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row team-profile">
				<div class="col-xs-3">
					<img src="{{ asset('img/sidqy.jpg') }}" class="img-rounded img-responsive">
				</div>
				<div class="col-xs-9">
					<h2>Sidqy Yusuf Suyuti Purboyo</h2>
					<h3>Data Entry</h3>
					<p><span class="glyphicon glyphicon-user"></span> Biro X, Student IT Community</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop