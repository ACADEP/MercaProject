<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{config('configurations.general.store_name')}} | Cliente</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="{{config('configurations.general.mini_logo')}}" />
  <link rel="stylesheet" href="{{asset('/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('/AdminLTE/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/skins/skin-blue.css')}}">

  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/tabs.css')}}">

  <!-- <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/bootstrap-datetimepicker.min.css')}}"> -->

  <!-- include summernote css/js-->


  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        
  
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo" style="background-color: #000 !important;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{config('configurations.general.mini_logo')}}" style="float: left; width: 80%; height: 50%; margin-left: 10%; margin-top: 10%;"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img class="img-responsive" src="{{config('configurations.general.main_logo')}}" style="float: left; width: 80%; height: 50%; margin-left: 10%"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" style="background-color: #FBFBFB !important;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color: #FBFBFB !important;">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="{{ url('/cart') }}" style="color: #000 !important;">Ir al Carrito</a>

          </li>
       
          <!-- User Account Menu -->
          <li class="dropdown user user-menu" style="background-color:black;">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="margin-right: 10px;">
              <!-- The user image in the navbar-->
              <img src="/AdminLTE/dist/img/user.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="background: #212121;">
                <img src="/AdminLTE/dist/img/user.png" class="img-circle" alt="User Image">

                <p>
                  {{ Auth::user()->email }}
                  <small style="padding-top: 10px;">Cliente</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('/') }}" class="btn btn-default btn-flat" >Mercadata</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background-color: #000 !important;">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="background-color: #000 !important;">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/AdminLTE/dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->username }}</p>
       
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="background-color: #000 !important; color: #fff !important;"><strong>Perfil</strong></li>
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview {{ Request::segment(2) == 'personal' ? 'active' : '' }}">
          <a href="#"><i class="fa fa-user-circle"></i> <span>Mi Perfil</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="background-color: #242424 !important;">
            <li class="{{ Request::segment(3) == 'data' ? 'active' : '' }}"><a href="{{ route('customer.personal') }}"><i class="fa fa-address-card"></i>Datos Personales</a></li>
            <li class="{{ Request::segment(3) == 'acount' ? 'active' : '' }}"><a href="{{ route('customer.acount') }}"><i class="fa fa-id-card"></i>Datos de Cuenta</a></li>
            <li class="{{ Request::segment(3) == 'address' ? 'active' : '' }}"><a href="{{ route('customer.address') }}"><i class="fa fa-address-book"></i>Direcciones</a></li>
            {{-- <li class="{{ Request::segment(3) == 'payments' ? 'active' : '' }}"><a href="{{ route('customer.payments') }}"><i class="fa fa-credit-card-alt"></i>Métodos de Pago</a></li> --}}
          </ul>
        </li>
        {{-- <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{ route('my-products') }}"><i class="fa fa-shopping-cart"></i> <span>Pedidos</span></a></li> --}}
        <li class="{{ Request::segment(2) == 'favorites' ? 'active' : '' }}"><a href="{{ route('my-favorites') }}"><i class="fa fa-heart"></i> <span>Favoritos</span></a></li>
        <li class="{{ Request::segment(2) == 'profile' ? 'active' : '' }}"><a href="{{ route('my-shopping') }}"><i class="fa fa-list"></i> <span>Mis Compras</span></a></li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content container-fluid">        
        @yield('content')
    

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Mercadata
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="#">Acadep</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Actividad Reciente</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('/AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- <script src="{{asset('/AdminLTE/dist/js/bootstrap-datetimepicker.min.js')}}"></script> -->

<script src="{{asset('AdminLTE/dist/summernote/summernote.js')}}"></script>

<script src="{{asset('/js/ajax-customer-cards.js')}}"></script>
<script src="{{asset('/js/ajax-customer-address.js')}}"></script>
{{-- @stack('scripts') --}}

<script src="{{asset('/js/dropzone.js')}}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<!-- Openpay -->
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
           OpenPay.setId('mk5lculzgzebbpxpam6x');
           OpenPay.setApiKey('pk_26757cbb5f7f44e8b31a2aed751c285c');
           OpenPay.setSandboxMode(true);
   });
</script>
<script src="{{ asset('/js/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/AdminLTE/dist/js/ajax-favorites.js') }}"></script>


  @yield('acount')
  @yield('modal-reclame')
  @yield('add-images')
  @yield('js-dropzone')
  @yield('msg')
  @yield('ajax-refresh')
  @include('customer.partials.add-card')
  @include('customer.partials.add-address')
  @include('customer.partials.add-personaldate')
  {{-- @include('customer.partials.update-personaldate') --}}

  @yield('mostrar-modal')

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. -->
</body>
</html>