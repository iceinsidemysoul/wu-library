<!DOCTYPE html>
<html>
	<head>
		<title>Library Timeline</title>
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/custom/jquery-ui/jquery-ui.min.css">
		<link rel="stylesheet" href="/custom/font-awesome/css/font-awesome.min.css">
		<!--
		<link rel="stylesheet" href="/css/timeline.css">
		<link rel="stylesheet" href="/css/post-card.css">
		-->
		<link rel="stylesheet" href="/css/wu.css">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		
	</head>
	<body>
		<script src="https://apis.google.com/js/platform.js" async defer></script>

		<!-- Place this tag after the last share tag. -->
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/platform.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=293243721081552';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="container-fluid" id="app">
			@yield('content')
		</div>
		@include('spa-layouts.footer')
		<script src="/js/app.js"></script>
		<script src="/custom/jquery-ui/jquery-ui.min.js"></script>
		<!--<script src="/js/timeline.js"></script> -->
	</body>
</html>