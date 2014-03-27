@extends('layouts.main')

@section('title', 'Verifikasi Nilai')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>@yield('title')</h1>
			</div>
		</div>
		<div class="col-md-12">
			@if ( Session::has('verify_first') )
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Dirimu tidak bisa menggunakan fitur sistem ini sebelum memverifikasi nilaimu.
			</div>
			@endif
			@if ( Auth::user()->verifikasi )
			<div class="alert alert-success">
				<p>Nilaimu sudah diverifikasi.</p>
				<p>Jika ada kesalahan nilai, hubungi {{ $operator->role }}: <b>{{ $operator->nama }}</b> di kelas <b>{{ $operator->kelas->nama }}</b> untuk merubah nilaimu.</p>
			</div>
			@else
			<p>Periksa kembali apakah nilai yang tertera di bawah ini sesuai dengan nilai yang tertera di Pangkalan Data Sekolah dan Siswa (PDSS) SNMPTN 2014.</p>
			<p>Jika nilaimu tidak benar, hubungi {{ $operator->role }}: <b>{{ $operator->nama }}</b> di kelas <b>{{ $operator->kelas->nama }}</b> untuk merubah nilaimu.</p>
			<p class="text-danger"><span class="label label-danger">Penting!</span> <strong>Dirimu tidak dapat menggunakan sistem ini sebelum memverifikasi nilai.</strong></p>
			@endif
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th></th>
						<th>Mata Pelajaran</th>
						@foreach ( $semester as $nilai )
						<th width="{{ 60 / ( count($semester) + 1 ) }}%">
							Smt. {{ $nilai['data']->semester }}<br>
							di {{ Kelas::find( $nilai['data']->kelas_id )->nama }}
						</th>
						@endforeach
						<th width="{{ 60 / ( count($semester) + 1 ) }}%">Rataan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					function nilai( $value ) {
						return ( $value == 0 ? '-' : $value );
					}
					?>
					<tr>
						<td>1</td>
						<td>Pendidikan Agama</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->AGM < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->AGM ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->AGM, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Pendidikan Kewarganegaraan</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->KWN < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->KWN ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->KWN, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>3</td>
						<td>Bahasa Indonesia</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->IND < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->IND ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->IND, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Bahasa Inggris</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->ING < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->ING ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->ING, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Matematika</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->MAT < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->MAT ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->MAT, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Fisika</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->FIS < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->FIS ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->FIS, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>7</td>
						<td>Kimia</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->KIM < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->KIM ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->KIM, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>8</td>
						<td>Biologi</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->BIO < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->BIO ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->BIO, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>9</td>
						<td>Sejarah</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->SJR < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->SJR ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->SJR, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>10</td>
						<td>Geografi</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->GEO < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->GEO ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->GEO, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>11</td>
						<td>Ekonomi</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->EKO < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->EKO ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->EKO, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>12</td>
						<td>Sosiologi</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->SOS < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->SOS ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->SOS, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>13</td>
						<td>Seni Budaya</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->SNB < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->SNB ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->SNB, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>14</td>
						<td>Pendidikan Jasmani, Olahraga, dan Kesehatan</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->PJO < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->PJO ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->PJO, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>15</td>
						<td>Teknologi Informasi dan Komunikasi</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->TIK < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->TIK ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->TIK, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td>16</td>
						<td>Keterampilan/Bahasa Asing</td>
						@foreach ( $semester as $nilai ) <td{{ $nilai['data']->KBA < 75 ? ' class="danger"' : '' }}>{{ nilai( $nilai['data']->KBA ) }}</td> @endforeach
						<td><b>{{ number_format( $rataan->KBA, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td colspan="{{ count($semester) + 2 }}" align="right"><b>Rata-rata nilai mata pelajaran Ilmu Pengetahuan Alam</b></td>
						<td><b>{{ number_format( $rataan_ipa, 2, ',', '' ) }}</b></td>
					</tr>
					<tr>
						<td colspan="{{ count($semester) + 2 }}" align="right"><b>Rata-rata nilai mata pelajaran Ilmu Pengetahuan Sosial</b></td>
						<td><b>{{ number_format( $rataan_ips, 2, ',', '' ) }}</b></td>
					</tr>
				</tbody>
			</table>
			@if ( ! Auth::user()->verifikasi )
			{{ Form::open( array('route' => 'self.verify') ) }}
			<div class="panel panel-default">
				<div class="panel-body">
					<p>Dengan mengklik tombol di bawah ini, Anda menyatakan bahwa nilai yang tertera di atas adalah benar sesuai dengan data yang dikeluarkan oleh Kurikulum.</p>
					<p><strong>Nilai yang sudah diverifikasi tidak dapat dirubah lagi.</strong></p>
				</div>
				<div class="panel-footer">
					{{ Form::submit('Verifikasi nilai saya!', array('class' => 'btn btn-primary btn-block btn-lg')) }}
				</div>
			</div>
			{{ Form::close() }}
			@endif
		</div>
	</div>
</div>
@stop