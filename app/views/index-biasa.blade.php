@extends('layouts.main')

@section('title', 'Selamat Datang')

@section('content')
<div class="jumbotron">
	<div class="container">
		<h1>Simulasi SNMPTN 2014</h1>
		<p>Beritahukan ranking dan pilihan universitasmu&mdash;kemudian lihat pilihan universitas orang lain, termasuk ranking paralel mereka. Mudah-mudahan membantumu meneguhkan hati dalam SNMPTN 2014.</p>
		<p>
			<a href="{{ URL::route('auth.login') }}" class="btn btn-primary btn-lg">Login sekarang &raquo;</a>
		</p>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h2>Berbagi data.</h2>
			<p>Atas persetujuan kelasmu, bagikan data ranking paralel teman-teman satu kelasmu melalui operator kelas masing-masing.</p>
		</div>
		<div class="col-md-4">
			<h2>Bagikan pilihan.</h2>
			<p>Beritahukan kepada orang lain pilihan universitasmu di SNMPTN 2014 untuk membantu mereka&mdash;dan dirimu sendiri&mdash;menentukan pilihan.</p>
		</div>
		<div class="col-md-4">
			<h2>Analisa. Pertimbangkan.</h2>
			<p>Pada akhirnya, lihat persainganmu ke universitas pilihan. Pertimbangkan. Berdoa. Lalu tetapkan pilihan.</p>
		</div>
	</div>
</div>
@stop