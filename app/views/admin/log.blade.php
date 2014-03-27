@extends('layouts.main')

@section('title', 'Lihat Log Sistem')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1>
					@yield('title')
				</h1>
			</div>
			<div class="well well-sm" id="log">
				@if ( !Input::has('reverse') )
				@for ( $i = count($log) - 1; $i >= 0; $i-- )
				<p>{{ $log[$i] }}</p>
				@endfor
				@else
				@for ( $i = 0; $i < count($log); $i++ )
				<p>{{ $log[$i] }}</p>
				@endfor
				@endif
			</div>
			<style type="text/css">
			#log {
				font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
				font-size: 12px;
				min-width: 550px;
			}
			#log p {
				line-height: 1em;
				margin: 0.5em 0;
			}
			</style>
		</div>
	</div>
</div>
@stop