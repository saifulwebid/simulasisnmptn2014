<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') - Simulasi SNMPTN 2014 - SMA Negeri 2 Bandung</title>

		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<style type="text/css">
body {
	padding-top: 50px;
	padding-bottom: 20px;
}
		</style>
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
					<a class="navbar-brand" href="#">Simulasi SNMPTN 2014</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						@if ( Auth::check() )
						<p class="navbar-text">Halo, {{ Auth::user()->nama }}!</p>
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
			<hr>
			<p>
				&copy; Student IT Community, Biro XII, 2014.<br>
				Ini merupakan sistem simulasi. Keakuratan data yang ada di sistem ini bergantung pada validitas data yang dientri oleh siswa dan operator kelas. Tidak untuk digunakan sebagai acuan sepenuhnya dalam pengambilan keputusan personal SNMPTN 2014.
			</p>
		</footer>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</body>
</html>