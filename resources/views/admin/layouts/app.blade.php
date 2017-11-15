<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Walailak University</title>
  <link rel="stylesheet" href="/css/admin.css">
  <link rel="stylesheet" href="/custom/font-awesome/css/font-awesome.min.css">
</head>

<body>
  <div id="admin">
    <div class="container-fluid">
      @include('admin.layouts.header')
    </div>
    <div class="container">
      @yield('content')
    </div>
      
  </div>
  <script src="/js/admin.js"></script>
</body>

</html>
