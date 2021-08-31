<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="perfect-scrollbar-on">
<head>
        <head>
          <meta charset="utf-8" />
          <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/alarm.png')}}">
          <link rel="icon" type="image/png" href="{{asset('images/alarm.png')}}">
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Emergency Notification System</title>
  
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{asset('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
  <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
  @yield('customcss')
</head>
<body>
  <div class="wrapper">
        <div class="sidebar" data-color="rose" data-background-color="black" data-image="{{asset('assets/img/sidebar-2.jpg')}}">
      <div class="logo">
        <a href="{{url('home')}}" class="simple-text logo-mini">
            {{ config('app.appcode', 'Laravel') }}
        </a>
        <a href="{{url('home')}}" class="simple-text logo-normal">
            {{ config('app.name', 'Laravel') }}
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="{{ session('profilepic')??asset('assets/img/boy.png') }}" />
          </div>
          <div class="user-info">
            <a>
              <h4>{{ Auth::user()->name }}</h4>
            </a>
          </div>
        </div> 
        <ul class="nav">
        <li class="{{Request::segment(1)=='home' ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/home">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          <li class="{{Request::segment(1)=='clustername' ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="/clustername">
              <i class="material-icons">reply_all</i>
              <p>Send Notifications</p>
            </a>
          </li>
          <li class="{{Request::segment(1)=='reciver-date' ? 'nav-item active' : 'nav-item'}}">
            <a class="nav-link" href="{{ route('reciver_date') }}">
            <i class="material-icons">folder_shared</i>
              <p>Disasters History</p> 
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                  <i class="material-icons">logout</i>
                  <p>Logout</p>
                </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
              </form>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
    @include('layouts.navbar')
            @yield('content')
    @include('layouts.footer')
           
    </div>
  </div>

  @stack('bootstrap')
              <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
               <!--   Core JS Files   -->
              <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
              <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
              <script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
              <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
              <!--  Plugin for Sweet Alert -->
              <script src="{{asset('assets/js/plugins/sweetalert2.js')}}"></script>
              <!-- Forms Validations Plugin -->
              <script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
              <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
              <script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
              <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
              <script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
              <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
              <script src="{{asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
              <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
              <script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
              <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
              <script src="{{asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
              <!-- Chartist JS -->
              <script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
              <script src="{{asset('assets/js/plugins/chartist-plugin-tooltip.min.js')}}"></script>
              <!--  Notifications Plugin    -->
              <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
              <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
              <script src="{{asset('assets/js/material-dashboard.js?v=2.1.0')}}" type="text/javascript"></script>
              <!-- Material Dashboard DEMO methods, don't include it in your project! -->
              
              <script src="{{asset('assets/js/js.js')}}"></script>           
  @stack('plugin')
  
</body>
</html>