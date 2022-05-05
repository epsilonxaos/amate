@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
@endpush

@section('contenido')
    <div class="section eventos">
        <div class="eventos-banner text-center bg" style="background-image: url({{asset('img/eventos/banner.jpg')}})">
            <h3>Eventos</h3>
        </div>

        <div class="eventos-informacion">
            <div class="container">
                <div class="row">


                @foreach($eventos as $evento)
                   {{-- <div class="col-12 col-sm-12 col-md-12 m30 text-center">
                        <img src="{{asset('storage/evento/'.$evento->portada)}}" class="w-100" alt="{{$evento -> titulo}}">
                        <h5 class="mt-3">{{$evento -> titulo}}</h5>
                        <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}" class="btn btn-primary rounded-pill mt-2">Vér Más</a>
                    </div>--}}
                    <div class="col-12 col-md-4">
                        <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}">
                            <div class="eventos-content">
                                <div class="cover" style="background-image: url({{asset('storage/evento/'.$evento->portada)}})">
                                    <img src="https://dummyimage.com/270x340/a19fa1/4a50a8.gif" class="invisible w-100" alt="">
                                </div>
                                <div class="footer text-center">
                                    <h5>{{$evento -> titulo}}</h5>
                                    <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}" class="btn btn-primary rounded-pill mt-2">Vér Más</a>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
                <div class="row">
                    {{ $eventos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
