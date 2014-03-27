@extends('layouts.filter')

@section('title', 'Lihat Data Angkatan (grafik peminat PTN)')

@section('scripts')
@if ( App::environment('local') )
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/jquery.highchartTable-min.js') }}"></script>
@else
<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="http://code.highcharttable.org/master/jquery.highchartTable-min.js"></script>
@endif
<script src="{{ asset('js/jquery.tablesorter.min.js') }}"></script>
<script src="{{ asset('js/jquery.tablesorter.widgets.min.js') }}"></script>
@stop

@section('inner-content')
	<div id="chart" style="height: 600px;"></div>
	<table class="table" data-graph-container="#chart" data-graph-type="column" data-graph-yaxis-1-stacklabels-enabled="1" data-graph-xaxis-rotation="-60" data-graph-xaxis-align="right" data-graph-yaxis-1-title-text="Jumlah Peminat (orang)" data-graph-subtitle-text="Dikelompokkan berdasarkan peminatan pilihan 1, 2, dan 3">
		<caption style="display: none">Jumlah Peminat Perguruan Tinggi Negeri</caption>
		<thead>
			<tr>
				<th>Nama Perguruan Tinggi Negeri</th>
				<th data-graph-stack-group="1">Peminat Pilihan 1</th>
				<th data-graph-stack-group="1">Peminat Pilihan 2</th>
				<th data-graph-stack-group="1">Peminat Pilihan 3</th>
				<th data-graph-skip="1" data-sorter="false"></th>
			</th>
		</thead>
		<tbody>
			@foreach ( $rekap as $data )
			<tr>
				<td style="vertical-align: middle">{{ $data->nama }}</td>
				<td style="vertical-align: middle">{{ $data->pil_1 }}</td>
				<td style="vertical-align: middle">{{ $data->pil_2 }}</td>
				<td style="vertical-align: middle">{{ $data->pil_3 }}</td>
				<td style="vertical-align: middle"><a href="{{ URL::route('filter.rekap.ptn', $data->id) }}" class="btn btn-success btn-sm">Lihat Grafik Detil</a> <a href="{{ URL::route('filter.prodi', array('ptn' => $data->id, 'prodi' => '-')) }}" class="btn btn-primary btn-sm">Lihat Peminat PTN</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<script type="text/javascript">
	$(document).ready(function() {
		$('table').highchartTable();
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