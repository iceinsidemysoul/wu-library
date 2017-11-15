<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="/css/app.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="/custom/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  {{-- <link href="/css/sb-admin.css" rel="stylesheet"> --}}
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 mt-5">
        <div class="card card-login mx-auto">
          <div class="card-header text-center">
            <h3>Walailak University</h3>
            Login
          </div>
          <div class="card-body p-4">
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username">Username:</label>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>

            </form>
            <div class="text-center">
              <a class="d-block small mt-3" href="forgot-password.html">Forgot Password?</a>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    
  <!-- Bootstrap core JavaScript-->
  {{-- <script src="/js/app.js"></script> --}}
</body>

</html>
