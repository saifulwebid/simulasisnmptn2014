@extends('layouts.main')

@section('title', 'Perbaiki Nilai Siswa')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					@yield('title')
					di Kelas {{ Auth::user()->kelas->nama }}
				</h1>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>NIS</th>
						<th>Nama Lengkap</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $data as $siswa )
					<tr {{ $siswa->verifikasi == 1 ? 'class="success"' : '' }}>
						<td>{{ $siswa->nis }}</td>
						<td>{{ $siswa->nama }}</td>
						<td>
							@if ( $siswa->verifikasi == 0 )
							<a href="{{ URL::route('operator.nilaisiswa', $siswa->id) }}" class="btn btn-primary btn-xs">Perbaiki Nilai</a>
							@else
							<span class="label label-success">Nilai sudah diverifikasi</span>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop