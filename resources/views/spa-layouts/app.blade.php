<!DOCTYPE html>
<html>
	<head>
		<title>Library Timeline</title>
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/custom/jquery-ui/jquery-ui.min.css">
		<link rel="stylesheet" href="/css/timeline.css">
		<link rel="stylesheet" href="/css/post-card.css">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<div class="container-fluid" id="app">
			@yield('content')
		</div>
		<script src="/js/app.js"></script>
		<script src="/custom/jquery-ui/jquery-ui.min.js"></script>
		<script src="/js/timeline.js"></script>
	</body>
</html>