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

</head>
<body>

<div id="app">

<nav class="navbar-expand-sm navbar-dark bg-primary p-0 sticky-top">
  <div class="container">
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
      <a href="/" class="navbar-brand">KECMP</a>
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @if(Request::route()->getName() != 'home')
        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link active"><i class="fa fa-tachometer"></i> Dashboard</a>
        </li>
        @endif
        <li class="nav-item dropdown px-2">
          <a href="{{ route('home') }}" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-navicon"></i> Manage</a>
          <div class="dropdown-menu">
            <a href="{{ route('admin.registrations.index') }}" class="dropdown-item">Registrations</a>
            <a href="{{ route('admin.literacies.index') }}" class="dropdown-item">Literacy</a>
            <a href="{{ route('admin.bridals.index') }}" class="dropdown-item">Bridal</a>
            <a href="{{ route('admin.marriages.index') }}" class="dropdown-item">Marriage</a>
            <a href="{{ route('admin.kids.index') }}" class="dropdown-item">Kids</a>
            <a href="{{ route('admin.preachings.index') }}" class="dropdown-item">Preaching</a>
            <a href="{{ route('admin.recommendations.index') }}" class="dropdown-item">Recommendations</a>            
            <a href="{{ route('admin.singers.index') }}" class="dropdown-item">Singers</a>
            <a href="{{ route('admin.commission_reports.index') }}" class="dropdown-item">Commissions</a>           
            <!-- <a href="{{ route('admin.teachings.index') }}" class="dropdown-item">New Believers</a> (= registration with new = status) -->
            <!-- <a href="{{ route('admin.receptions.index') }}" class="dropdown-item">From Elsewhere</a> (= registration with active = status and origin parish != kinamba) -->
            <!-- <a href="{{ route('admin.baptisms.index') }}" class="dropdown-item">Baptism</a> (from new status to active) -->            
            <!-- <a href="{{ route('admin.suspensions.index') }}" class="dropdown-item">Suspension</a> (= registration with status = suspended) -->
            <!-- <a href="{{ route('admin.repentings.index') }}" class="dropdown-item">Repenting</a> (= registration with status = reinstated) -->
            <!-- <a href="{{ route('admin.burials.index') }}" class="dropdown-item">Burials</a> (= registration with status = dead) -->            
          </div>
        </li>
        <li class="nav-item dropdown px-2">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i>Parameters</a>
          <div class="dropdown-menu">                        
            <a href="{{ route('admin.categories.index') }}" class="dropdown-item">Categories</a>
            <a href="{{ route('admin.cells.index') }}" class="dropdown-item">Cells</a>
            <a href="{{ route('admin.chapelles.index') }}" class="dropdown-item">Chapelles</a>
            <a href="{{ route('admin.choirs.index') }}" class="dropdown-item">Choirs</a>
            <a href="{{ route('admin.commissions.index') }}" class="dropdown-item">Commissions</a>
            <a href="{{ route('admin.dioceses.index') }}" class="dropdown-item">Dioceses</a>
            <a href="{{ route('admin.districts.index') }}" class="dropdown-item">Districts</a>
            <a href="{{ route('admin.duties.index') }}" class="dropdown-item">Duties</a>
            <a href="{{ route('admin.degrees.index') }}" class="dropdown-item">Education</a>            
            <a href="{{ route('admin.parishes.index') }}" class="dropdown-item">Parishes</a>
            <a href="{{ route('admin.privileges.index') }}" class="dropdown-item">Privileges</a>
            <a href="{{ route('admin.provinces.index') }}" class="dropdown-item">Provinces</a>
            <a href="{{ route('admin.roles.index') }}" class="dropdown-item">Roles</a>
            <a href="{{ route('admin.sectors.index') }}" class="dropdown-item">Sectors</a>
            <a href="{{ route('admin.services.index') }}" class="dropdown-item">Services</a>
            <a href="{{ route('admin.statuses.index') }}" class="dropdown-item">Statuses</a>
            <a href="{{ route('admin.tasks.index') }}" class="dropdown-item">Tasks</a>
            <a href="{{ route('admin.types.index') }}" class="dropdown-item">Types</a>
            <a href="{{ route('admin.villages.index') }}" class="dropdown-item">Villages</a>
            <a href="{{ route('admin.zones.index') }}" class="dropdown-item">Zones</a>
          </div>
        </li>
        <li class="nav-item px-2">
          <a href="{{ route('admin.users.index') }}" class="nav-link"><i class="fa fa-users"></i> Users</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown mr-3">
            <span class="nav-link">
              <i class="fa fa-user"></i> {{ Auth::user()->name }}
            </span>
          <!--
          <div class="dropdown-menu">
            <a href="../profile.html" class="dropdown-item">
              <i class="fa fa-user-circle"></i> Profile
            </a>
            <a href="../settings.html" class="dropdown-item">
              <i class="fa fa-gear"></i> Settings
            </a>
          </div>
          -->
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
        <!--
        <li class="nav-item dropdown px-2">
          <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#villageModal">
            <i class="fa fa-plus"></i> Add Village
          </a>          
        </li>
        -->
      </ul>
    </div>
  </div>
</nav>

<header id="main-header" class="mb-4 text-black" style="background-color: #fff;">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <strong>@yield('header')</strong>
      </div>
    </div>
  </div>
</header>

  <div class="container">
    <div class="row">
      <div class="col-md text-center">
        @include('includes.sessions')
      </div>
    </div>    
  </div>

@yield('content')

<vue-noty></vue-noty>

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

</div>

<!-- Scripts -->
<!--
<link rel="stylesheet" href="https://drvic10k.github.io/bootstrap-sortable/Contents/bootstrap-sortable.css" />
-->

<!-- 
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
-->


<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!--
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
-->
<script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
<!--
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
  <script src="https://drvic10k.github.io/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
-->
  <script src="{{ asset('js/moment.js') }}"></script>
  <script src="{{ asset('js/bootstrap-sortable.js') }}"></script>
  
  <script src="{{ asset('js/ajaxsearch.js') }}"></script>

  <!-- Styles -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">

  <!-- including the 3 js files below causes dropdown issues
    
  <script src="{{ asset('js/popper.js') }}"></script>
  <script src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>  
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  including the 3 js files below causes dropdown issues -->
  <script src="{{ asset('js/app.js') }}"></script>

  <script src="{{ asset('js/getparams.js') }}"></script>

@yield('scripts')

</body>
</html>
