<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Advisory Board</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/css/bootstrap.css') !!}"/>
    <!-- morris CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/js/morrisjs/morris.css') !!}"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/css/style.css') !!}"/>

    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/css/custom.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/css/sumoselect.css') !!}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">


    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/js/multiselect/css/multi-select.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/js/bootstrap-select/bootstrap-select.min.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('/assets/css/jquery.datetimepicker.css') !!}" />

{!! HTML::script('assets/js/jquery.min.js') !!}

<!-- Bootstrap tether Core JavaScript -->
{!! HTML::script('assets/js/popper.min.js') !!}

{!! HTML::script('assets/js/bootstrap.min.js') !!}

<!--Wave Effects -->
{!! HTML::script('assets/js/waves.js') !!}

<!--Menu sidebar -->
{!! HTML::script('assets/js/sidebarmenu.js') !!}

<!--Custom JavaScript -->
{!! HTML::script('assets/js/custom.min.js') !!}

<!--morris JavaScript -->
{{--{!! HTML::script('assets/js/raphael/raphael-min.js') !!}--}}
{{--{!! HTML::script('assets/js/morrisjs/morris.min.js') !!}--}}

<!-- Chart JS -->
{{--{!! HTML::script('assets/js/dashboard1.js') !!}--}}

{!! HTML::script('assets/js/common.js') !!}
{!! HTML::script('assets/js/sticky-kit.min.js') !!}
{!! HTML::script('assets/js/jquery.slimscroll.js') !!}
<!-- This is data table -->
{!! HTML::script('assets/js/datatables/jquery.dataTables.min.js') !!}

<!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    {!! HTML::script('assets/js/styleswitcher/jQuery.style.switcher.js') !!}
    {!! HTML::script('assets/js/select2.full.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-select/bootstrap-select.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') !!}
    {!! HTML::script('assets/js/multiselect/js/jquery.multi-select.js') !!}
    {!! HTML::script('assets/js/jquery-ui.js') !!}

    {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>--}}
    {!! HTML::script('assets/js/jquery.sumoselect.js') !!}
    {!! HTML::script('assets/js/jquery.datetimepicker.full.min.js') !!}

</head>

<body class="fix-header fix-sidebar card-no-border">
<div id="preloader"></div>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript: void(0)" style="font-family: 'Brush Script MT'; font-size: 28px; margin: 0 auto; width: 1230px;">
                    Sharepeeps Advisory Board
                    {{--<img src="{!! asset('assets/images/main-logo.png') !!}" alt="homepage" class="light-logo" />--}}
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto mt-md-0">
                    <!-- This is  -->
                    {{--<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>--}}
                    {{--<li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>--}}
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Language -->
                    <!-- ============================================================== -->
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right scale-up"> --}}
                         {{--<a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>--}}
                    {{--</li>--}}
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{!! getLogoImage() !!}" alt="user" class="profile-pic" /></a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="{!! getLogoImage() !!}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{!! getUserName() !!}</h4>
                                            {{--<p class="text-muted">varun@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>--}}
                                    </div>
                                </li>
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>--}}
                                {{--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>--}}
                                {{--<li><a href="#"><i class="ti-email"></i> Inbox</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>--}}
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                {{--<li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>--}}
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile">
                <!-- User profile image -->
                <div class="profile-img"> <img src="{!! getLogoImage() !!}" alt="user" />
                    <!-- this is blinking heartbit-->
                    <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                </div>
                <!-- User profile text-->
                <div class="profile-text">
                    <h5>{!! getUserName() !!}</h5>
                    {{--<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>--}}
                    {{--<a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>--}}
                    {{--<a href="pages-login.html" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>--}}
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        {{--<a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>--}}
                        <!-- text-->
                        {{--<a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>--}}
                        <!-- text-->
                        {{--<a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>--}}
                        <!-- text-->
                        {{--<div class="dropdown-divider"></div>--}}
                        <!-- text-->
                        {{--<a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>--}}
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="nav-devider @if(!empty($page) && $page == 'file') dashboard @endif"></li>
                    <li @if(!empty($page) && $page == 'file') class="active" @endif>
                        <a class="waves-effect waves-dark @if(!empty($page) && $page == 'file') active @endif" href="{!! URL::route('files.list') !!}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Home</span></a>
                    </li>
                        <li @if(!empty($page) && $page == 'user') class="active" @endif>
                            <a class="waves-effect waves-dark @if(!empty($page) && $page == 'user') active @endif" href="{!! URL::route('users.list') !!}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users</span></a>
                        </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
@yield('content')
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
</body>

</html>