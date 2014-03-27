@extends('layouts.main')

@section('title', 'Reset Password Siswa')

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
					<tr>
						<td>{{ $siswa->nis }}</td>
						<td>{{ $siswa->nama }}</td>
						<td><a href="{{ URL::route('operator.resetsiswa', $siswa->id) }}" class="btn btn-danger btn-xs">Reset Password</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop