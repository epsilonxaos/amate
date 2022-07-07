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
                <div style="
                    background-image: url({{asset('img/exp.jpg')}});
                    background-position: center left;
                    background-size: cover;
                    background-repeat: no-repeat;
                    height: 70vh;
                    width: 100%;
                "></div>
                {{-- <img src="{{asset('img/exp.jpg')}}" alt="" class="w-100" style="height: 70vh; object-fit: cover"> --}}

                <div class="text-center" style="position: absolute; bottom: 50px; left: 0; width: 100%; z-index: 2;">
                    <button class="btn btn-white fw-500" data-fancybox data-src="https://www.youtube.com/watch?v=V9k9QPQ4vl8">Ver video</button>
                </div>
            </div>
        </div>

        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="titulo mb-3">{{(App::getLocale() == 'en') ? 'About Us' : 'Nosotros'}}</h2>
                </div>
                <div class="col-12 col-md-6">
                    @if (App::getLocale() == 'en')
                        
                        <p>Amate experiences seeks to be the bridge between Yucatan, its culture, its roots and the

                            travelers looking for something more than a conventional trip, those looking to enjoy the
                            experience of becoming just another local.</p>

                        <p>Through experiences designed by local people, your trip will become
                            in a true life adventure.</p>
                    @else
                        
                        <p>Amate experiences busca ser el puente entre Yucatan, su cultura, sus raíces y los

                            viajeros que buscan algo más que un viaje convencional, aquellos que buscan disfrutar la
                            experiencia de convertirse en un local más.</p>

                        <p>A través de experiencias diseñadas de la mano de personas locales, tu viaje se convertirá
                            en una verdadera aventura de vida.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<link rel="stylesheet" href="{{asset('plugins/@fancyapps/jquery.fancybox.min.css')}}">
<script src="{{asset('plugins/@fancyapps/jquery.fancybox.min.js')}}"></script>
@endpush