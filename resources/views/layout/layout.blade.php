<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>TestCoding - {{ $title }}</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css">

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-responsive.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/signin.css') }}">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="brand" href="{{ url('/') }}">TestCoding - Qtasnim - Dede Rian </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
        @if($title == 'Login' || $title == 'Register' || $title == 'Forbidden')
			<li class=""><a href="{{ url('/') }}" class=""><i class="icon-chevron-left"></i> Back to Homepage</a></li>
        @else
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if(auth()->user() != null)
                <li><a href="javascript:;"><i class="icon-user"></i> Profile</a></li>
                <li><a href="{{ url('/logout') }}"><i class="icon-signout"></i> Logout</a></li>
                @else
                <li><a href="{{ url('/login/' .Crypt::encrypt('login')) }}"><i class="icon-signin"></i> Login</a></li>
                <li><a href="{{ url('/register/' .Crypt::encrypt('register')) }}"><i class="icon-edit"></i> Register</a></li>
                @endif
            </ul>
          </li>
        @endif
        </ul>
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
@if($title != 'Login' && $title != 'Register' && $title != 'Forbidden')
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        @if($title == 'Home')
        <li class="active">
        @else
        <li>
        @endif
            <a href="{{ url('/') }}"><i class="icon-home"></i><span>Home</span></a>
        </li>
        @if(auth()->user() != null)
            @if(auth()->user()->level == 1)
            @if($title == 'Transaksi' || $title == 'Barang' || $title == 'Jenis Barang')
            <li class="dropdown active">
            @else
            <li class="dropdown">
            @endif
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user-md"></i><span>Admin <i class="icon-arrow-down"></i></span><b class="caret"></b>
                </a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('/transaksi') }}"><i class="icon-list"></i> Transaksi</a></li>
                <li><a href="{{ url('/barang') }}"><i class="icon-edit"></i> Barang</a></li>
                <li><a href="{{ url('/jenisBarang') }}"><i class="icon-edit"></i> Jenis Barang</a></li>
            </ul>
            </li>
            @endif
            @if(auth()->user()->level == 1 || auth()->user()->level == 2)
                @if($title == 'API')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="{{ url('/') }}"><i class="icon-cogs"></i><span>API</span></a>
                </li>
            @endif
            <li>
                <a href="{{ url('/logout') }}"><i class="icon-signout"></i><span>Logout</span></a>
            </li>
        @endif
        @if(auth()->user() == null)
        <li>
            <a href="{{ url('/login/' .Crypt::encrypt('login')) }}"><i class="icon-signin"></i><span>Login</span></a>
        </li>
        @endif
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
@endif
<div class="main">
  <div class="main-inner">
      @yield('content')
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<div class="extra">
    <div class="extra-inner">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <h4>Me</h4>
                    <ul>
                        <li><a target="_blank" href="https://www.linkedin.com/in/dede-rian/"><i class="icon-linkedin-sign"></i> Linked In</a></li>
                        <li><a target="_blank" href="https://github.com/r2itech"><i class="icon-github-sign"></i> Github</a></li>
                    </ul>
                </div>
                <div class="span3">
                    <h4>PT Qtasnim Digital Teknologi</h4>
                    <ul>
                        <li><a target="_blank" href="https://qtasnim.com/"><i class="icon-globe"></i> Site</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row--> 
        </div>
        <!-- /container --> 
    </div>
    <!-- /extra-inner --> 
</div>
<!-- /extra -->

<div class="footer">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="span12">
                &copy; 2021 <a href="#">TestCoding - Qtasnim</a>
                </div>
                <!-- /span12 --> 
            </div>
            <!-- /row --> 
        </div>
        <!-- /container --> 
    </div>
    <!-- /footer-inner --> 
</div>
<!-- /footer -->
</body>
<!-- Modal -->
<div id="add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Thank you for visiting EGrappler.com</h3>
    </div>
    <div class="modal-body">
      <p>One fine body…</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button class="btn btn-primary">Save changes</button>
    </div>
</div>
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="{{ asset('assets/js/jquery-1.7.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/excanvas.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/js/chart.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/signin.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/base.js') }}"></script>

<!-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>

@yield('datatable')

</html>
