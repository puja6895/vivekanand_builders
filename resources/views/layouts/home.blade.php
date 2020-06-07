<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  {{-- <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
  <!-- Font -->
  <!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables -->
  {{-- <link rel="stylesheet" href="{{asset('public/tables/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('tables/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('tables/datatables-responsive/css/responsive.bootstrap4.min.css')}}">


  <script>
    function active(element){
      element.classList.add("active")
    }
  </script>

  <style>
    .pull-right {
      float: right !important;
    }

    .card-border{
      border-top: 2px solid #4e88bb ;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed" style="font-size: 0.8rem">
   <!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
          <a href="../../index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> --}}
      </ul>
      <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media"> --}}
              {{-- <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
              {{-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          {{-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media"> --}}
              {{-- <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              {{-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          {{-- </a> --}}
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            {{-- <div class="media"> --}}
              {{-- <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> --}}
              {{-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> --}}
            <!-- Message End -->
          {{-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
      <!-- Authentication Links -->
      @guest
      <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
      </li>
      @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
      @endif
  @else
      <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
      </li>
  @endguest
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
      {{-- <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Vivekanand Builders</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
           <a href="{{route('home')}}"  class="nav-link @yield('dashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link @yield('POS')">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               POS
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('sell')}}" class="nav-link @yield('POS-sell')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="{{route('customers')}}" class="nav-link @yield('clients')">
               <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                Clients
                 {{-- <i class="right fas fa-angle-left"></i> --}}
               </p>
            </a>
           </li>

           <li class="nav-item">
           <a href="{{route('products')}}"  class="nav-link @yield('Product')">
               <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                 Products
                 {{-- <i class="right fas fa-angle-left"></i> --}}
               </p>
             </a>
           </li>

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link @yield('Master')">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Master Data
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('units')}}" class="nav-link @yield('Master-unit')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('categories')}}" class="nav-link @yield('Master-unit')">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>

         </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0

    </div>
    <strong>Copyright &copy; 2020  All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- DataTables -->
{{-- <script src="{{asset('public/tables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/tables/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> --}}

<script src="{{asset('tables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('tables/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('tables/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('tables/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/demo.js')}}"></script>

<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true
    });

    $('.select2').select2();

    //Date picker
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    })
  })
</script>

</body>
</html>