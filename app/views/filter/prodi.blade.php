@extends('layouts.filter.rank')

@section('title', 'Lihat Data Angkatan (berdasarkan program studi PTN)')

@section('ranking')
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lihat Peminat Per Program Studi di Perguruan Tinggi Negeri</h3>
				</div>
				<div class="panel-content">
					<div class="row">
					@foreach ( Auth::user()->pilihan as $pilihan )
						<div class="col-md-{{ 12 / count( Auth::user()->pilihan ) }}">
							<a href="{{ URL::route('filter.prodi', array('ptn' => $pilihan->ptn->id, 'prodi' => $pilihan->prodi->id)) }}" class="btn btn-block btn-success">
								Lihat peminat program studi<br>{{ $pilihan->prodi->nama }}<br>di {{ $pilihan->ptn->nama }}
							</a>
						</div>
					@endforeach
					</div>
					<p class="or"><span>atau lihat program studi lain</span></p>
					{{ Form::open( array('route' => 'filter.prodi', 'method' => 'get', 'class' => 'form-horizontal') ) }}
							<div class="form-group">
								{{ Form::label('ptn', 'PTN', array( 'class' => 'col-md-1 control-label' )) }}
								<div class="col-md-3">
									{{ Form::select('ptn', $ptn, Input::get('ptn'), array('class' => 'form-control')) }}
								</div>
								{{ Form::label('prodi', 'Program Studi', array( 'class' => 'col-md-2 control-label' )) }}
								<div class="col-md-4">
									@if ( !isset($data))
									<select id="prodi" name="prodi" class="form-control" disabled>
										<option value="-">Pilih dulu PTN di samping...</option>
									</select>
									@else
									{{ Form::select('prodi', $prodi[Input::get('ptn')], Input::get('prodi'), array('class' => 'form-control')) }}
									@endif
								</div>
								<div class="col-md-2">
									{{ Form::submit('Lihat data', array('class' => 'btn btn-primary btn-block')) }}
								</div>
							</div>
					{{ Form::close() }}
				</div>
			</div>
			<script type="text/javascript">
			$(document).ready(function() {
				$("select[name='ptn']").change( function() {
					var selectptn = $(this);
					var selectprodi = selectptn.parent().parent().find("select[name='prodi']");

					if ( selectptn.val() == '-' ) {
						selectprodi.prop("disabled", true);
						selectprodi.html("<option value='-'>Pilih dulu PTN di samping...</option>");
					} else {
						selectprodi.prop("disabled", true);
						selectprodi.html("<option>Loading prodi...</option>");
						$.ajax({
							type: "get",
							url: "{{ URL::route('ajax.ptn') }}",
							data: "ptn=" + selectptn.val(),
							success: function( data ) {
								selectprodi.prop("disabled", false);
								var option = '<option value="-">Semua program studi</option>';
								$.each(data, function( index, value ) {
									option += '<option value="' + value.id + '">' + value.nama + '</option>';
								});
								selectprodi.html(option);
							}
						});
					}
				});
			});
			</script>
			@if ( isset($data) )
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						@if ( Input::get('prodi') !== '-' )
						Peminat Program Studi <b>{{ $cur_prodi->nama }}</b> di <b>{{ $cur_prodi->ptn->nama }}</b>
						@else
						Peminat Program Studi <b>{{ $cur_ptn->nama }}</b>
						@endif
					</h3>
				</div>
				<div class="panel-content">
					<table class="table table-condensed table-striped table-hover">
						<thead>
							<tr>
								<th rowspan="2">Nama Lengkap</th>
								<th rowspan="2">Kelas</th>
								<th colspan="2" data-sorter="false">Rataan Nilai</th>
								<th colspan="2" data-sorter="false">Ranking Paralel</th>
								<th rowspan="2">Program Studi</th>
								<th rowspan="2">Prioritas</th>
								<th rowspan="2" style="display: none">Rank Jurusan</th>
							</tr>
							<tr>
								<th>IPA</th>
								<th>IPS</th>
								<th>IPA</th>
								<th>IPS</th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $data as $list )
							<tr {{ ( $list['entry']->id == $self_id ) ? 'class="info"' : '' }}>
								<td>{{ $list['entry']->nama }}</td>
								<td>{{ $list['entry']->kelas }}</td>
								<td>{{ $list['bidang'] == 'IPA' ? '<b>' : '' }}{{ number_format( $list['entry']->IPA, 2, ',', '' ) }}{{ $list['bidang'] == 'IPA' ? '</b>' : '' }}</td>
								<td>{{ $list['bidang'] == 'IPS' ? '<b>' : '' }}{{ number_format( $list['entry']->IPS, 2, ',', '' ) }}{{ $list['bidang'] == 'IPS' ? '</b>' : '' }}</td>
								<td>{{ $list['bidang'] == 'IPA' ? '<b>' : '' }}{{ $list['entry']->rank->IPA }}{{ $list['bidang'] == 'IPA' ? '</b>' : '' }}</td>
								<td>{{ $list['bidang'] == 'IPS' ? '<b>' : '' }}{{ $list['entry']->rank->IPS }}{{ $list['bidang'] == 'IPA' ? '</b>' : '' }}</td>
								<td>{{ $list['prodi']->nama }}</td>
								<td>{{ $list['pilihan'] }}</td>
								<td style="display: none">{{ $list['prodi']->bidang == 'IPA' ? $list['entry']->rank->IPA : $list['entry']->rank->IPS }}</td>
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
							widgets: [ "uitheme" ],
							sortList: [[6,0], [8,0]]
						});
					});
					</script>
				</div>
			</div>
			@endif
@stop