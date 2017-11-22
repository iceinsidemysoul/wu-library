<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		{{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta property="fb:app_id" content="545176412487935">
		@yield('og', '')
		<title>@yield ('title') </title>
		<link href="/favicon_black.ico" rel="shortcut icon">
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/custom/jquery-ui/jquery-ui.min.css">
		<link rel="stylesheet" href="/custom/font-awesome/css/font-awesome.min.css">
		<!--
		<link rel="stylesheet" href="/css/timeline.css">
		<link rel="stylesheet" href="/css/post-card.css">
		-->
		<link rel="stylesheet" href="/css/wu.css">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		
	</head>
	<body>
		@yield ('social', '')
		<div class="container-fluid" id="app">
			@include('spa-layouts.header')
			@yield('content')
		</div>
		@include('spa-layouts.footer')
		<script src="/js/app.js"></script>
		<script src="/custom/jquery-ui/jquery-ui.min.js"></script>
		@include('spa-layouts.social-api')
		<!--<script src="/js/timeline.js"></script> -->
	</body>
</html>