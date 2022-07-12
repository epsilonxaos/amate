@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
    <style>
        .font-weight-bold {
            color: #153D3C;
        }
    </style>
@endpush

@section('contenido')
    <div class="eventos-detalle pt-5">
        <div class="container-fluid w14">

            <h2 class="titulo text-center mb-5">{{(App::getLocale() == 'en') ? 'Gallery' : 'Galeria'}}</h2>

            <div class="row">
                @for ($i = 1; $i <= 31; $i++)
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <img src="{{asset('img/galeria/'.$i.'.jpg')}}" alt="Galeria" data-fancybox="Galeria" data-src="{{asset('img/galeria/'.$i.'.jpg')}}" style="cursor: zoom-in; object-fit: cover;" height="220px" width="100%">
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@push('js')
    <link rel="stylesheet" href="{{asset('plugins/@fancyapps/jquery.fancybox.min.css')}}">
    <script src="{{asset('plugins/@fancyapps/jquery.fancybox.min.js')}}"></script>
@endpush