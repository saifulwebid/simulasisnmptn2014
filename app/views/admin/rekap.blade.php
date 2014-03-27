@extends('layouts.main')

@section('title', 'Progress Input Data')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					@yield('title')
				</h1>
			</div>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama Kelas</th>
						<th>Validasi</th>
						<th>Memilih</th>
						<th>Progress</th>
						<th>Operator</th>
						<th class="hidden-print"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $data as $kelas )
					<tr>
						<td>{{ $kelas->nama }}</td>
						<td><b>{{ $count_verifikasi[$kelas->id] }}</b> / {{ count($kelas->siswa) }}</td>
						<td><b>{{ $count_pilih[$kelas->id] }}</b> / {{ count($kelas->siswa) }}</td>
						<td>{{ number_format(( $count_verifikasi[ $kelas->id ] + $count_pilih[ $kelas->id ] ) / ( count($kelas->siswa) * 2 ) * 100, 1) }}%</td>
						<td>
							<ul>
							@foreach ( $kelas->siswa as $siswa )
							@if ( $siswa->role == 'admin' || $siswa->role == 'operator')
								<li>{{$siswa->role}}: <b>{{$siswa->nama}}</b></li>
							@endif
							@endforeach
							</ul>
						</td>
						<td class="hidden-print"><a href="{{ URL::route('admin.kelas', $kelas->id) }}" class="btn btn-xs btn-primary">Lihat Detil Kelas</a></td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>Total Siswa</th>
						<th>{{ $total['verifikasi'] }} / {{ $total['siswa'] }}</th>
						<th>{{ $total['pilih'] }} / {{ $total['siswa'] }}</th>
						<th>{{ number_format(( $total['verifikasi'] + $total['pilih'] ) / ( $total['siswa'] * 2 ) * 100, 1) }}%</th>
						<th></th>
						<th class="hidden-print"></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@stop