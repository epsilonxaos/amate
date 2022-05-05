<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Panel Administrativo para controlar los recursos">
        <meta name="author" content="Locker Agencia">
        <title>Panel</title>
        <!-- Favicon -->
        <link rel="icon" href="{{asset('panel/img/brand/favicon.png')}}" type="image/png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <!-- Icons -->
        <link rel="stylesheet" href="{{asset('panel/vendor/nucleo/css/nucleo.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('panel/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{asset('panel/css/main.css?v=1.2.0')}}" type="text/css">
    </head>

<body class="bg-default">
<!-- Main content -->
<div class="main-content">
    @yield('content')
</div>
    
    {{-- <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    
    <script src="../assets/js/argon.js?v=1.2.0"></script> --}}
</body>

</html>