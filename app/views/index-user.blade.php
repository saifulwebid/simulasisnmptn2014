@extends('layouts.main')

@section('title', 'Selamat Datang')

@section('content')
<!--<div class="jumbotron">
	<div class="container">
		@if ( Auth::user()->role == 'operator' || Auth::user()->role == 'admin' )
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p><b>{{ Auth::user()->nama }}</b>, sekarang kamu adalah operator kelas <b>{{ Auth::user()->kelas->nama }}</b>.</p>
			<p>Bisakah kami meminta bantuan untuk mengajak teman-temanmu yang belum log in supaya mereka segera log in, dan memperbaiki nilai teman-temanmu bila mereka menyatakan demikian?</p>
			<p>Menu "Operator Kelas" sekarang tersedia untukmu. Silakan dilihat-lihat. :-)</p>
		</div>
		@endif
		<h2>Halo, {{ Auth::user()->nama }}!</h2>
		<h1>Simulasi SNMPTN 2014</h1>
		<p>Beritahukan ranking dan pilihan universitasmu&mdash;kemudian lihat pilihan universitas orang lain, termasuk ranking paralel mereka. Mudah-mudahan membantumu meneguhkan hati dalam SNMPTN 2014.</p>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="panel {{ (Auth::user()->verifikasi == 0) ? 'panel-primary' : 'panel-success' }}">
				<div class="panel-heading">
					<h2 class="panel-title">Verifikasi nilai.</h2>
				</div>
				<div class="panel-body">
					Atas persetujuan kelasmu, bagikan data ranking paralel teman-teman satu kelasmu melalui operator kelas masing-masing.
				</div>
				<div class="panel-footer">
					@if ( Auth::user()->verifikasi == 0 )
					<a href="{{ URL::route('self.verify') }}" class="btn btn-primary btn-block">Verifikasi nilaimu.</a>
					@else
					Dirimu sudah memverifikasi nilai. Terima kasih! :)
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel {{ (Auth::user()->verifikasi == 0) ? 'panel-danger' : 'panel-primary' }}">
				<div class="panel-heading">
					<h2 class="panel-title">Bagikan pilihan.</h2>
				</div>
				<div class="panel-body">
					Beritahukan kepada orang lain pilihan universitasmu di SNMPTN 2014 untuk membantu mereka&mdash;dan dirimu sendiri&mdash;menentukan pilihan.
				</div>
				<div class="panel-footer">
					@if ( Auth::user()->verifikasi == 0 )
					<strong>Maaf, dirimu harus memverifikasi nilai dulu sebelum membagikan pilihan.</strong>
					@else
					<a href="{{ URL::route('self.pilihan') }}" class="btn btn-primary btn-block">
						@if ( count(Auth::user()->pilihan) == 0 )
						Tentukan pilihanmu, sekarang!
						@else
						Berubah pikiran? Rubah pilihanmu!
						@endif
					</a>
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel {{ (Auth::user()->verifikasi == 0 || count(Auth::user()->pilihan) == 0 ) ? 'panel-danger' : 'panel-primary' }}">
				<div class="panel-heading">
					<h2 class="panel-title">Analisa, pertimbangkan.</h2>
				</div>
				<div class="panel-body">
					Pada akhirnya, lihat persainganmu ke perguruan tinggi negeri pilihanmu. Pertimbangkan. Berdoa. Lalu tetapkan pilihan.
				</div>
				<div class="panel-footer">
					@if ( Auth::user()->verifikasi == 0 )
					<strong>Maaf, dirimu harus memverifikasi nilai dulu sebelum melihat data angkatan.</strong>
					@else
						@if ( count(Auth::user()->pilihan) == 0 )
						<strong>Maaf, dirimu harus menentukan pilihan dulu sebelum melihat data angkatan.</strong>
						@else
						<a href="{{ URL::route('filter.main') }}" class="btn btn-primary btn-block">Lihat bagaimana persaingannya...</a>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>-->
<style type="text/css">
.panel {
	box-shadow: 0 0 10px #ccc;
}
.panel-title {
	font-size: 20px;
}
.panel-letter .panel-body {
	font-size: 15px;
}
.glyphicon-folder-open, .glyphicon-time {
	margin-left: 10px;
}
.glyphicon-user, .glyphicon-folder-open, .glyphicon-time {
	margin-right: 5px;
}
</style>
<div class="container" style="margin-top: 1em; margin-bottom: 1em;">
	@if ( Auth::user()->role == 'operator' || Auth::user()->role == 'admin' )
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<p><b>{{ Auth::user()->nama }}</b>, sekarang kamu adalah operator kelas <b>{{ Auth::user()->kelas->nama }}</b>.</p>
				<p>Bisakah kami meminta bantuan untuk mengajak teman-temanmu yang belum log in supaya mereka segera log in, dan memperbaiki nilai teman-temanmu bila mereka menyatakan demikian?</p>
				<p>Menu "Operator Kelas" sekarang tersedia untukmu. Silakan dilihat-lihat. :-)</p>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Terburu-buru?</h2>
				</div>
				<div class="panel-body">
					<p>Jika dirimu tidak sedang buru-buru, bacalah pesan berikut ini. Jika tidak, silakan bernavigasi:</p>
				</div>
				<div class="panel-footer">
					@if ( Auth::user()->verifikasi == 0 )
					<a href="{{ URL::route('self.verify') }}" class="btn btn-primary btn-block">Verifikasi nilaimu sebelum melihat persaingan.</a>
					@else
					<a href="{{ URL::route('self.pilihan') }}" class="btn btn-primary btn-block">
						@if ( count(Auth::user()->pilihan) == 0 )
						Tentukan pilihanmu sebelum melihat persaingan.
						@else
						Berubah pikiran? Rubah pilihanmu ...
						@endif
					</a>
						@if ( count(Auth::user()->pilihan) > 0 )
						<a href="{{ URL::route('filter.main') }}" class="btn btn-success btn-block">... dan lihat bagaimana persaingannya ...</a>
						@endif
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-success panel-letter panel-collapsible">
				<div class="panel-heading clickable panel-collapsed">
					<h2 class="panel-title">
						{{ Auth::user()->nama }}, terima kasih banyak! :-)
						<span class="pull-right"><i class="glyphicon glyphicon-chevron-down"></i></span>
					</h2>
				</div>
				<div class="panel-body" style="display: none;">
					<p>Halo, <b>{{ Auth::user()->nama }}</b>! :-)</p>
					<p>Pertama-tama, saya sangat berterimakasih karena kamu mau bergabung, memverifikasi nilai, dan saling berbagi pilihan perguruan tinggi masing-masing di sistem ini.</p>
					<p>Boleh curhat sedikit, kan? <small>*sedikit euy*</small></p>
					<p>Masih ingat waktu ranking paralel dibagikan oleh sekolah? Waktu itu banyak teman-teman&mdash;termasuk kami&mdash;yang ingin tahu, <i>"siapa saja sih orang-orang yang rankingnya di atas aku dan mereka mau ke mana"</i>. Oke, data itu sudah dibagikan ke kelas-kelas, tapi untuk meringkas data mentah sedemikian, kita perlu <i>effort</i> lebih untuk itu.</p>
					<p>Maka, setelah kami berdiskusi, satu minggu kemudian keluarlah Sistem Simulasi SNMPTN 2014 ini.</p>
					<p>Sistem Simulasi SNMPTN ini proyek kilat. Dibuatnya terburu-buru. Banyak <i>error</i> di sana-sini waktu awal-awal diluncurkan. Dan kami sangat berterima kasih kepada Divisi IT SMA Negeri 2 Bandung yang berkenan memberikan <i>server</i> kepada kami untuk menampung data ini. Sehingga kemudian kita sama-sama melihat, lebih dari 300 orang sekarang sudah bergabung dan membagikan pilihan dengan kita. (Kesenangan tersendiri ketika melihat aplikasi yang kita buat dibuka di mana-mana&mdash;di kantin, di koridor kelas, di gerbang sekolah, di manapun. <i>Thank you so much!</i>)</p>
					<p><i>Guys,</i></p>
					<p>Sekarang tanggal 22 Maret 2014 ketika saya menulis ini. Malam ini sepertinya sudah banyak dari kita yang mendaftarkan diri dan finalisasi di portal SNMPTN 2014. Saya berharap sistem simulasi ini membantu memberikan gambaran tentang persaingan yang sama-sama akan kita hadapi di luar sana.</p>
					<p>Karenanya, malam ini saya ingin berterima kasih kepada teman-teman <a href="{{ URL::to('about') }}">Biro XII dan Biro X di Student IT Community SMA Negeri 2 Bandung</a> yang sudah berbaik hati membantu kami mengerjakan proyek ini, terutama menginput data lebih dari 400 siswa.</p>
					<p>Terima kasih saya juga untuk para operator kelas, Windu di IPA 1, Eki di IPA 2, Sulastri di IPA 3, Ryantio di IPA 4, Davina di IPA 5, Anti dan Rosella di IPA 7, Ari dan Matias di IPA 8, Tyo dan Ryan di IPA 9, Elgin di IPS 1, dan Fathia di IPS 2. Ya Tuhan, betapa terbantu sekali kami dengan mereka melayani teman-teman untuk revisi nilai dan reset password di hari-hari terakhir ini.</p>
					<p>Dan, <b>terima kasih buatmu, {{ Auth::user()->nama }}, atas partisipasinya.</b> <i>Really ......</i> saya berterimakasih banyak padamu! Sistem ini nggak berarti apa-apa kalau nggak ada yang pakai. :-D</p>
					<p>Kami mohon maaf jika selama kamu menggunakan sistem ini banyak kekurangan, banyak kesalahan, banyak hal-hal yang kurang berkenan dari kami kepada kalian. Mohon maaf sekali ....... >_< </p>
					<p>Pada akhirnya saya berharap dan berdoa semoga semua usaha kita dalam meraih masa depan ini dimudahkan dan dilancarkan Tuhan Yang Maha Esa, khususnya semoga pilihan kita semua di SNMPTN 2014 diberkati Tuhan dan dikabulkan.</p>
					@if ( count(Auth::user()->pilihan) > 0 )
					<p><i>Ya Tuhan, khususnya bagi temanku ini, <b>{{ Auth::user()->nama }}</b>, perkenankan ia berkuliah di tempat yang ia inginkan, di <b>{{ Auth::user()->pilihan->first()->prodi->nama }} {{ Auth::user()->pilihan->first()->ptn->nama }}</b>, dan semoga di pendidikan lanjutan yang Kau ridhai itu Kau jadikan temanku ini orang yang berguna bagi agama, bangsa, dan negara.</i></p>
					@endif
					<p><b>Kesuksesanlah bagi SMA Negeri 2 Bandung '14,<br>
						Berjayalah sepanjang masa.</b></p>
					<p>Sampai bertemu di puncak kesuksesan, semua ....! ^_^</p>
					<p>&nbsp;</p>
					<p>Cimahi, 22 Maret 2014, 21:30 WIB</p>
					<p>Project Manager Sistem Simulasi SNMPTN 2014,<br>Muhammad Saiful Islam</p>
					<p class="text-danger">P.S.: Sistem Simulasi SNMPTN ini akan saya tutup tidak lama setelah Pak Asep Suryanto menyatakan pendaftaran ditutup bagi SMA Negeri 2 Bandung. Kalau kamu tertarik untuk mengetahui data apa saja yang dikumpulkan dari sistem ini, hubungi kami! :-)</p>
					<p class="text-info"><b>P.S.S.: Kalau sudah finalisasi di SNMPTN 2014, pastikan kamu juga mengupdate pilihanmu di sistem simulasi ini! Ajak juga teman-teman yang belum login ke sini untuk mengisi datanya! :-)</b></p>
				</div>
			</div>
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
			@if ( Auth::user()->testimoni == null )
			<script type="text/javascript">
			$('.panel-heading.clickable').click();
			</script>
			{{ Form::open() }}
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Boleh dong minta kesan dan pesannya sebentar? Ya? ;-)</h2>
				</div>
				<div class="panel-body">
					{{ Form::text('testimoni', null, array('class' => 'form-control', 'placeholder' => 'Apapun deh. Curhat. Komentar. Makian. Apapuuun boleeeeh! :-)', 'autocomplete' => 'off')) }}
				</div>
				<div class="panel-footer">
					{{ Form::submit('Kirimkan!', array('class' => 'btn btn-success btn-block')) }}
				</div>
			</div>
			{{ Form::close()}}
			@endif
			@if ( Session::has('thanks_testimoni') )
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success alert-dismissable" id="thanks_testimoni">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>Terima kasih, kamu sudah mengisi kesan dan pesan! :-)</p>
						<p>
							Mungkin setelah ini kamu mau
							@if ( Auth::user()->verifikasi == 0 )
							<a href="{{ URL::route('self.verify') }}" class="btn btn-primary btn-xs">verifikasi nilai?</a>
							@else
							<a href="{{ URL::route('self.pilihan') }}" class="btn btn-primary btn-xs">
								@if ( count(Auth::user()->pilihan) == 0 )
								menentukan pilihan?
								@else
								merubah pikiran
								@endif
							</a>
								@if ( count(Auth::user()->pilihan) > 0 )
								atau
								<a href="{{ URL::route('filter.main') }}" class="btn btn-success btn-xs">melihat persaingan?</a>
								@endif
							@endif
						</p>
					</div>
				</div>
			</div>
			@endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Kesan dan pesan dari para pengguna:</h2>
				</div>
				<ul class="list-group">
					@foreach ( Testimoni::with('siswa', 'siswa.kelas')->orderBy('created_at', 'desc')->get() as $testimoni )
					<li class="list-group-item">
						{{ $testimoni->testimoni }}<br>
						<small class="text-info">
							<span class="glyphicon glyphicon-user"></span> {{ $testimoni->siswa->nama }}
							<span class="glyphicon glyphicon-folder-open"></span> {{ $testimoni->siswa->kelas->nama }}
							<span class="glyphicon glyphicon-time"></span> {{ $testimoni->created_at }}
						</small>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@stop