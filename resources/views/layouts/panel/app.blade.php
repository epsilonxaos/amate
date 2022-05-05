<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panel Administrativo para controlar los recursos">
    <meta name="author" content="Locker Agencia">
    <meta name="csrf-token" content="{{csrf_token()}}">
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
    @stack('css')
</head>

<body>
    @include('include.panel.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        @include('include.panel.navbar')
        @yield('content')
    </div>
    <script>
        const PATH = "{{asset('/')}}";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('panel/vendor/filestyle/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('panel/js/main.js?v=1.2.0')}}"></script>
    @stack('js')
    <script src="{{asset('panel/js/panel.js')}}"></script>

</body>

</html>
