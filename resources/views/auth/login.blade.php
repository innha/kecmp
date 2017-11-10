<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 
  <title>Kinamba e-church Management Platform</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'KECMP') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body id="app">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <div class="container">
    <button class="navbar-toggler" data-toggle="collapse" target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <a href="index.html" class="navbar-brand">KECMP</a> -->
    <a href="{{ url('/') }}" class="navbar-brand">KECMP</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
        </li>
      </ul>

    </div>
  </div>
</nav>

<!-- HOME SECTION -->
<header id="home-section">
  <div class="dark-overlay">
    <div class="home-inner">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 d-none d-sm-block"></div>
          <div class="col-sm-4 d-none d-sm-block py-4">
            <!--
            <div class="card bg-primary text-center card-form">              
              <div class="card-header"><h3>Log in</h3></div>
              <div class="card-body">                
              -->
                <h3>Log in</h3>
                <!-- <p>Please fill out this form to register</p> -->
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <!-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> -->

                        <!-- <div class="col-md-6"> -->
                            <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        <!-- </div> -->
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

                        <!-- <div class="col-md-6"> -->
                            <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        <!-- </div> -->
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                            <!--
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                            -->
                        </div>
                    </div>
                </form>
              <!-- 
              </div>
            </div>            
          </div>
          -->
          <div class="col-sm-4 d-none d-sm-block"></div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- MAIN FOOTER -->
<footer id="main-footer" class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <div class="py-4">
          <h1 class="h3">KECMP</h1>
          <p>Copyright &copy; 2017</p>          
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts -->
<!-- 
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
