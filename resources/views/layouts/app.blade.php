<!DOCTYPE html>
<html lang="en">
<head>
    @include('include.metas')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/futura/stylesheet.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @stack('link')
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