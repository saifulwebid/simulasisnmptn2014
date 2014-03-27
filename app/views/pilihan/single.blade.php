@extends('layouts.main')

@section('title', 'Tentukan Pilihan')

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
		<div class="col-md-8">
			@if (Session::has('success'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Pilihan PTN dan program studimu berhasil disimpan!
			</div>
			@endif
			@if (Session::has('pilih_dulu'))
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Dirimu harus memilih pilihan PTN dan program studi dulu sebelum menggunakan fitur di sistem ini.
			</div>
			@endif
			<p>Tuhan, inilah doa kami, kabulkanlah; semoga saya dapat diterima di program studi berikut ini:</p>
			<p><span class="label label-info">Catatan:</span> Pilihan ini masih dapat dirubah lagi nantinya.</p>
			{{ Form::open(array('route' => 'self.pilihan', 'class' => 'form-horizontal')) }}
				@for ( $i = 1; $i <= 3; $i++ )
				<div class="form-group">
					{{ Form::label('ptn[' . $i . ']', 'Pilihan ' . $i, array( 'class' => 'col-sm-2 control-label' )) }}
					<div class="col-sm-5">
						{{ Form::select('ptn[' . $i . ']', $ptn, $pilihan[$i]['ptn'], array('class' => 'form-control')) }}
					</div>
					<div class="col-sm-5">
						@if ($pilihan[$i]['ptn'] == null)
						<select id="prodi[{{ $i }}]" name="prodi[{{ $i }}]" class="form-control" disabled>
							<option value="-">Pilih dulu PTN di samping...</option>
						</select>
						@else
						{{ Form::select('prodi[' . $i . ']', $prodi[$pilihan[$i]['ptn']], $pilihan[$i]['prodi'], array('class' => 'form-control')) }}
						@endif
					</div>
				</div>
				@endfor
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{{ Form::submit('Tentukan pilihan!', array('class' => 'btn btn-primary btn-block')) }}
					</div>
				</div>
			{{ Form::close() }}
			<script type="text/javascript">
			$(document).ready(function() {
				$("select[name^='ptn']").change( function() {
					var selectptn = $(this);
					var selectprodi = selectptn.parent().parent().find("select[name^='prodi']");

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
								var option = '<option value="-">Pilih program studi...</option>';
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
		</div>
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Kenapa saya harus memasukkan pilihan PTN dan program studi saya?</div>
				<div class="panel-body">
					<p>Karena dengan memasukkan pilihan PTN dan program studimu, dirimu dapat melihat teman-teman seangkatanmu yang menginginkan program studi yang sama. Selain itu, teman-temanmu juga dapat mengetahui bahwa dirimu menargetkan program studi tertentu.</p>
					<p>Maka <strong>jujurlah</strong> dengan pilihan yang akan dirimu masukkan. Mudah-mudahan Tuhan membantu kita dengan kejujuran kita itu. :-)</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop