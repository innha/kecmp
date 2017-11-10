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
    <!--
    <button class="navbar-toggler" data-toggle="collapse" target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    -->
    <!-- <a href="index.html" class="navbar-brand">KECMP</a> -->
    <a href="{{ url('/') }}" class="navbar-brand">KECMP</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mr-3">
        @if (Auth::guest())
          <a href="{{ route('login') }}" class="nav-link">
            <i class="fa fa-user"></i> Login
          </a>
        </li>
        @else
          <span class="nav-link">
            <i class="fa fa-user"></i> {{ Auth::user()->name }}
          </span>
        </li>
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link">
            <i class="fa fa-user-times"></i> Logout
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        @endif
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
          <div class="col-sm-12 d-none d-sm-block">
            <h1 class="display-4 text-center">Kinamba e-Church Management Platform</h1>
            <!--
            <div class="d-flex flex-row">
              <div class="p-4 align-self-start">
                <i class="fa fa-check"></i>
              </div>
              <div class="p-4 align-self-end">
                Restart the Acer Aspire netbook by pressing the "power"
                button on the netbook's keyboard or by pressing the
                "CTRL," "ALT" and "DEL" keys at the same time.
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="p-4 align-self-start">
                <i class="fa fa-check"></i>
              </div>
              <div class="p-4 align-self-end">
                Restart the Acer Aspire netbook by pressing the "power"
                button on the netbook's keyboard or by pressing the
                "CTRL," "ALT" and "DEL" keys at the same time.
              </div>
            </div>
            <div class="d-flex flex-row">
              <div class="p-4 align-self-start">
                <i class="fa fa-check"></i>
              </div>
              <div class="p-4 align-self-end">
                Restart the Acer Aspire netbook by pressing the "power"
                button on the netbook's keyboard or by pressing the
                "CTRL," "ALT" and "DEL" keys at the same time.
              </div>
            </div>
            -->
          </div>    
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
