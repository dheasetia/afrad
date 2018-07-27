<!DOCTYPE html>
<html lang="en" dir="rtl">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="برنامج الأفراد لإدارة المساعدات">
    <meta name="author" content="مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية">
    <meta property="og:title" content="أفراد لإدارة المساعدات">
    <meta property="og:description" content="برنامج إدارة المساعدات">
    <meta property="og:url" content="https://afrad.com">
    <meta property="og:image" content="https://afrad.com/plugins/images/icon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">
    <title>أفراد | لإدارة المساعدات</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('plugins/bower_components/bootstrap-rtl-master/dist/css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/colors/default.css')}}" id="theme" rel="stylesheet">
    <link href="{{asset('plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <style>
        .top-left-part .light-logo {
            margin: 5px 8px 0 0;
        }

        .top-left-part .light-logo-text {
            margin-top: 10px;
            margin-right: 10px;
        }



        .sidebar ul li a {
            font-family: DroidKufi;
            font-weight: bold;
        }
        .sidebar .nav-second-level li a {
            font-weight: normal;
        }
        .light-logo{
            height: 60px;
        }
        .light-logo-text {
            font-family: DroidKufi;
            font-weight: bold;
            color: black;
            font-size: 2em;
        }
        label {
            font-family: DroidKufi;
        }
        .box-title{
            font-weight: bold !important;
        }
        .control-label .required,
        .form-group .required {
            color: #e02222;
            font-size: 12px;
            padding-right: 2px;
        }
        .btn-add {
            margin-top: 25px;
            width: 60%
        }

        .form-actions {
            float: left;
        }

        .dropify-wrapper {
            font-family: DroidNaskh;
        }

        button.dropify-clear {
            font-family: DroidKufi !important;
        }

        .after-input {
            margin-top: 25px;
        }

        .nav.nav-second-level li a {
            margin-right: 18px;
        }

        .white-box .box-title {
            display: inline !important;
            font-size: 12pt;
        }

        .white-box .box-actions {
            float: left;
            margin-bottom: 25px;
        }

        .column-number {
            width: 90px;
        }

        .column-action {
            width: 100px;
            text-align: center;
        }

        .panel-footer {
            text-align: left;
        }

        .panel-heading {
            font-family: DroidKufi, sans-serif;
            font-size: 12pt;
        }

        .jq-toast-wrap {
            font-family: DroidNaskh, sans-serif !important;
        }
        .jq-toast-single {
            font-family: DroidNaskh, sans-serif !important;
        }
        .bold {
            font-weight: bold;
        }
        .box-title {
            display: inline-block;
        }
        .box-actions {
            float: left;
        }
        a.btn-primary {
            color: white;
        }
        a.btn-primary:hover {
            color: white;
        }

        h2.jq-toast-heading {
            font-family: DroidKufi, sans-serif !important;
            margin-top: 15px;
            font-weight: bold;
        }
        thead th {
            font-family: DroidKufi, sans-serif;
        }
        @media only screen and (max-width: 360px) {
            /* For mobile phones: */
            .btn-add {
                margin-top: 0;
                margin-bottom: 20px;
                width: 100%;
            }


        }
        @media only screen and (max-width: 1200px) {
            img.light-logo {
                margin: 0 !important;
            }
            .btn-add {
                width: 100%;
            }
        }
    </style>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-19175540-9', 'auto');
        ga('send', 'pageview');
    </script>
@yield('custom_style')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="fix-sidebar">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="ti-menu"></i>
            </a>
            <div class="top-left-part">
                <a class="logo" href="{{url('/')}}">
                    <b>
                        <!--This is dark logo icon-->
                        <!--This is light logo icon-->
                        <img src="{{asset('plugins/images/andalus_logo.png')}}" alt="home" class="light-logo"/>
                    </b>
                    <span class="hidden-xs">
                        <!--This is light logo text-->
                        <span class="light-logo-text">أفراد</span>
                    </span>
                </a>
            </div>
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li>
                    <a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light">
                        <i class="icon-arrow-right-circle ti-menu"></i>
                    </a>
                </li>
                <li>
                    <form role="search" class="app-search hidden-xs">
                        <input type="text" placeholder="بحث شامل ..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    @include('layouts.sidebar')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> {{date('Y')}} &copy; مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('bootstrap/dist/js/tether.min.js')}}"></script>
<script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bower_components/bootstrap-rtl-master/dist/js/bootstrap-rtl.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
<!--Style Switcher -->
@yield('plugin_scripts')
</body>
</html>
