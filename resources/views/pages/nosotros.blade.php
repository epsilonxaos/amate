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
        <div class="container-fluid" style="max-width: 1600px">

            <div class="wrapper position-relative">
                <img src="https://images.pexels.com/photos/1134188/pexels-photo-1134188.jpeg" alt="" class="w-100" style="height: 70vh; object-fit: cover">

                <div class="text-center" style="position: absolute; bottom: 50px; left: 0; width: 100%; z-index: 2;">
                    <button class="btn btn-white fw-500" data-fancybox data-src="https://www.youtube.com/watch?v=V9k9QPQ4vl8">Ver video</button>
                </div>
            </div>
        </div>

        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="titulo mb-3">Nosotros</h2>
                </div>
                <div class="col-12 col-md-6">
                    <p>Amate experiences busca ser el puente entre Yucatan, su cultura, sus raíces y los

                        viajeros que buscan algo más que un viaje convencional, aquellos que buscan disfrutar la
                        experiencia de convertirse en un local más.</p>

                    <p>A través de experiencias diseñadas de la mano de personas locales, tu viaje se convertirá
                        en una verdadera aventura de vida.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<link rel="stylesheet" href="{{asset('plugins/@fancyapps/jquery.fancybox.min.css')}}">
<script src="{{asset('plugins/@fancyapps/jquery.fancybox.min.js')}}"></script>
@endpush