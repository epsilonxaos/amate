<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    @include('include.metas')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/futura/stylesheet.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @stack('link')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }

        .my-float{
            margin-top:16px;
            color: white !important
        }
    </style>
</head>
<body>
    @include('include.menu')

    @include('include.loading')

    @yield('contenido')
    @include('modals.modal_folio')
    @include('include.footer')

    {{--@if (request()->is('murmurante_online') != 1 && request()->is('eventos/pago') != 1)
        <a href="{{route('front.murmurante_online')}}" class="btn-murmurante-online"><img src="{{asset('img/btn-murmurante-online.jpg')}}" alt="Murmurante online" class="w-max-100"></a>
    @endif--}}


    <script>
        const PATH = "{{url('/').'/'}}";
    </script>
    <script src="{{mix('js/app.js')}}"></script>
    @stack('js')
</body>
</html>