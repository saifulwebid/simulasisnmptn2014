@extends('layouts.main')

@section('title', 'Lihat Data Angkatan')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>Lihat Data Angkatan</h1>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Lihat Data Ranking Paralel</h2>
				</div>
				<div class="panel-body">
					<p>Lihat peringkatmu dari satu angkatan berdasarkan nilai mata pelajaran Ilmu Pengetahuan Alam (IPA) dan Ilmu Pengetahuan Sosial (IPS).</p>
				</div>
				<div class="panel-footer">
					<a href="{{ URL::route('filter.semester') }}" class="btn btn-block btn-primary">
						Lihat Data Ranking Paralel
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Lihat Peminat Program Studi di PTN</h2>
				</div>
				<div class="panel-body">
					<p>Selain melihat ranking paralel secara keseluruhan, dirimu dapat melihat dan memantau siapa saja teman-teman satu angkatan yang memiliki minat terhadap program studi tertentu.</p>
				</div>
				<div class="panel-footer">
					<a href="{{ URL::route('filter.prodi') }}" class="btn btn-block btn-primary">
						Lihat Peminat Program Studi di PTN
					</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Lihat Grafik Rekapitulasi</h2>
				</div>
				<div class="panel-body">
					<p>Lihat pula rekapitulasi persebaran peminatan program studi berupa grafik yang mudah dimengerti.</p>
				</div>
				<div class="panel-footer">
					<a href="{{ URL::route('filter.rekap') }}" class="btn btn-block btn-primary">
						Lihat Grafik Rekapitulasi
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop