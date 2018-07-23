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
    <link href="{{asset('plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- color CSS -->
    <link href="{{asset('css/colors/default.css')}}" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>404</h1>
            <h3 class="text-uppercase">عفوا، ليس لديك صلاحية مناسبة لفتح الصفحة</h3>
            <p class="text-muted m-t-30 m-b-30">الرجاء عمل تسجيل الدخول باسمك وكلمة المرور الخاصة بك</p>
            <a href="{{url('/')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">عودة للصفحة الرئيسية</a> </div>
        <footer class="footer text-center">&copy; {{date('Y')}} مؤسسة أحمد سالم بالحمر وعائلته الخيرية. </footer>
    </div>
</section>
<!-- jQuery -->
<script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('bootstrap/dist/js/tether.min.js')}}"></script>
<script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bower_components/bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js')}}"></script>
</body>

</html>
