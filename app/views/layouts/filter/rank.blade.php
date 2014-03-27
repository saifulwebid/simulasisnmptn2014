@extends('layouts.filter')

@section('scripts')
<script src="{{ asset('js/jquery.tablesorter.min.js') }}"></script>
<script src="{{ asset('js/jquery.tablesorter.widgets.min.js') }}"></script>
@stop

@section('inner-content')
			<div class="panel panel-info panel-collapsible">
				<div class="panel-heading clickable panel-collapsed">
					<h3 class="panel-title">
						Jawaban dari pertanyaan yang paling sering ditanyakan tentang tabel di bawah ini. (Sebaiknya dibaca.)
						<span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</h3>
				</div>
				<div class="panel-body" style="display: none;">
					<p>Sistem menentukan ranking paralel setiap siswa dengan cara sebagai berikut:</p>
					<ul>
						<li>Setiap mata pelajaran dirata-ratakan per semesternya. Sehingga nantinya akan ada nilai rata-rata Matematika, Bahasa Indonesia, Bahasa Inggris, dan sebagainya.</li>
						<li>Dibuat dua rata-rata: rata-rata nilai IPA dan rata-rata nilai IPS. Rata-rata nilai IPA diambil dari rata-rata Matematika, Bahasa Indonesia, Bahasa Inggris, Fisika, Kimia, dan Biologi. Rata-rata nilai IPS diambil dari rata-rata Matematika, Bahasa Indonesia, Bahasa Inggris, Ekonomi, Geografi, dan Sosiologi. <strong>Inilah yang disebut sebagai Rataan Nilai IPA dan IPS pada tabel ranking paralel.</strong></li>
						<li>Data kemudian diurutkan berdasarkan rata-rata nilai IPA dan IPS ini, sehingga terbentuklah ranking paralel IPA dan ranking paralel IPS.</li>
					</ul>
					<p><span class="label label-danger">Perhatikan!</span> Masing-masing PTN memiliki kebijakan sendiri mengenai cara menyusun ranking paralel. Karenanya, ranking paralel yang ada di sistem ini sebaiknya jangan dijadikan acuan mutlak. Cukuplah sekadar dijadikan gambaran dan sebagai salah satu bahan pertimbangan saja.</p>
				</div>
			</div>
			<p class="bg-info" style="padding: 3px 7px;">Pada tabel, namamu ditandai dengan warna latar belakang seperti ini.</p>
			<script type="text/javascript">
			$(document).on('click', '.panel-heading.clickable', function(e) {
				var $this = $(this);
				if ( $this.hasClass('panel-collapsed') ) {
					$this.parents('.panel').find('.panel-body').slideDown();
					$this.removeClass('panel-collapsed');
					$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
				} else {
					$this.parents('.panel').find('.panel-body').slideUp();
					$this.addClass('panel-collapsed');
					$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
				}
			});
			</script>
			@yield('ranking')
@stop