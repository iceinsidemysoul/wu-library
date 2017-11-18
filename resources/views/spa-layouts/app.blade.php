<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Library Timeline</title>
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
		<div class="container-fluid" id="app">
			@yield('content')
		</div>
		@include('spa-layouts.footer')
		<script src="/js/app.js"></script>
		<script src="/custom/jquery-ui/jquery-ui.min.js"></script>
		@include('spa-layouts.social-api')
		<!--<script src="/js/timeline.js"></script> -->
	</body>
</html>