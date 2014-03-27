<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title') - Simulasi SNMPTN 2014 - SMA Negeri 2 Bandung</title>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		@if ( App::environment('local') )
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/cerulean.css') }}" rel="stylesheet">
		@else
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/cerulean/bootstrap.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700' rel='stylesheet' type='text/css'>
		@endif

		<link href="{{ asset('css/theme.bootstrap.css') }}" rel="stylesheet">

		@yield('scripts')

		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ URL::to('/') }}">Simulasi SNMPTN 2014</a>
				</div>
				<div class="navbar-collapse collapse">
					@if ( Auth::check() )
					<ul class="nav navbar-nav">
						<li{{ Route::currentRouteName() == 'self.verify' ? ' class="active"' : ''}}>
							<a href="{{ URL::route('self.verify') }}">Verifikasi Nilai</a>
						</li>
						<li{{ Route::currentRouteName() == 'self.pilihan' ? ' class="active"' : ''}}>
							<a href="{{ URL::route('self.pilihan') }}">Tentukan Pilihan</a>
						</li>
						<li{{ Request::is('filter*') ? ' class="active"' : ''}}>
							<a href="{{ URL::route('filter.main') }}">Lihat Data</a>
						</li>
						<li{{ Route::currentRouteName() == 'self.password' ? ' class="active"' : ''}}>
							<a href="{{ URL::route('self.password') }}">Ganti Password</a>
						</li>
						@if ( Auth::user()->role == 'operator' || Auth::user()->role == 'admin' )
						<li class="dropdown {{ Request::is('operator*') ? 'active' : ''}}">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Operator Kelas <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li{{ Request::is('operator/rekap') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('operator.rekap') }}">Rekapitulasi Kelas</a>
								</li>
								<li{{ Request::is('operator/nilai*') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('operator.nilai') }}">Perbaiki Nilai Siswa</a>
								</li>
								<li{{ Request::is('operator/reset*') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('operator.reset') }}">Reset Password Siswa</a>
								</li>
							</ul>
						</li>
						@endif
						@if ( Auth::user()->role == 'admin' )
						<li class="dropdown {{ Request::is('admin*') ? 'active' : ''}}">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li{{ Request::is('admin/rekap*') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('admin.rekap') }}">Progress Input Data</a>
								</li>
								<li{{ Request::is('admin/nilai*') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('admin.nilai') }}">Perbaiki Nilai Siswa</a>
								</li>
								<li{{ Request::is('admin/reset*') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('admin.reset') }}">Reset Password Siswa</a>
								</li>
								<li{{ Request::is('admin/log') ? ' class="active"' : ''}}>
									<a href="{{ URL::route('admin.log') }}">Lihat Log Sistem</a>
								</li>
							</ul>
						</li>
						@endif
					</ul>
					@endif
					<ul class="nav navbar-nav navbar-right">
						@if ( Auth::check() )
						<li><a href="{{ URL::route('auth.logout') }}">Logout</a></li>
						@else
						<li><a href="{{ URL::route('auth.login') }}">Login</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>

		@yield('content')

		<footer class="container">
			<p>&copy; <a href="{{ URL::to('about') }}">Student IT Community &ndash; SMA Negeri 2 Bandung</a>, 2014.</p>
			<p class="text-danger">Ini merupakan sistem simulasi. Keakuratan data yang ada di sistem ini bergantung pada validitas data dari siswa.<br>Tidak untuk digunakan sebagai acuan sepenuhnya dalam pengambilan keputusan personal SNMPTN 2014.</p>
			<p class="hidden-print">Sistem ini paling enak dibuka di komputer dengan browser Google Chrome. <i>Coba deh.</i></p>
		</footer>
		@if ( !App::environment('local') )
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-48810248-1', 'sman2bdg.sch.id');
		  ga('send', 'pageview');
		</script>
		@endif
	</body>
</html>