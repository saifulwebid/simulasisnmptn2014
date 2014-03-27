@extends('layouts.filter.rank')

@section('title', 'Lihat Data Angkatan (berdasarkan ranking paralel)')

@section('ranking')
			<table class="table table-condensed table-striped table-hover">
				<thead>
					<tr>
						<th rowspan="2">Nama Lengkap</th>
						<th rowspan="2">Kelas</th>
						<th colspan="2" data-sorter="false">Rataan Nilai</th>
						<th colspan="2" data-sorter="false">Ranking Paralel</th>
						<th rowspan="2">Pilihan PTN</th>
					</tr>
					<tr>
						<th>IPA</th>
						<th>IPS</th>
						<th width="3%">IPA</th>
						<th width="3%">IPS</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $data as $entry )
					<tr {{ ( $entry->id == $self_id ) ? 'class="info"' : ( count($entry->pilihan) == 0 ? 'class="danger"' : '') }}>
						<td>{{ $entry->nama }}</td>
						<td>{{ $entry->kelas }}</td>
					@if ( count($entry->pilihan) !== 0 || ( Auth::user()->role == 'admin' && Input::has('god') ) )
						<td>{{ number_format( $entry->IPA, 2, ',', '' ) }}</td>
						<td>{{ number_format( $entry->IPS, 2, ',', '' ) }}</td>
						<td>{{ $entry->rank->IPA }}</td>
						<td>{{ $entry->rank->IPS }}</td>
						<td>
							@if ( count($entry->pilihan) > 0 )
								@foreach ( $entry->pilihan as $pilihan )
								{{ $pilihan->pilihan }}: {{ $pilihan->ptn->nama }} - {{ $pilihan->prodi->nama }}<br>
								@endforeach
							@endif
						</td>
					@else
						<td colspan="6"><span class="label label-warning">Dirinya belum verifikasi dan memilih PTN.</span></td>
					@endif
					</tr>
					@endforeach
				</tbody>
			</table>
			<script type="text/javascript">
			$(document).ready(function() {
				$.extend($.tablesorter.themes.bootstrap, {
					// these classes are added to the table. To see other table classes available,
					// look here: http://twitter.github.com/bootstrap/base-css.html#tables
					table      : 'table table-bordered',
					caption    : 'caption',
					header     : 'bootstrap-header', // give the header a gradient background
					footerRow  : '',
					footerCells: '',
					icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
					sortNone   : 'bootstrap-icon-unsorted',
					sortAsc    : 'icon-chevron-up glyphicon glyphicon-chevron-up',     // includes classes for Bootstrap v2 & v3
					sortDesc   : 'icon-chevron-down glyphicon glyphicon-chevron-down', // includes classes for Bootstrap v2 & v3
					active     : '', // applied when column is sorted
					hover      : '', // use custom css here - bootstrap class may not override it
					filterRow  : '', // filter row class
					even       : '', // odd row zebra striping
					odd        : ''  // even row zebra striping
				});
				$('table').tablesorter({
					theme: "bootstrap",
					headerTemplate: '{content} {icon}',
					widgets: [ "uitheme" ]
				});
			});
			</script>
@stop