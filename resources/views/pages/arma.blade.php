@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
    <style>
        .font-weight-bold, p {
            color: #153D3C !important;
        }
    </style>
@endpush

@section('contenido')
    <div class="eventos-detalle pt-5" style="background-color: #ac7a4333;">
        <div class="container" >
            <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4"><img class="h-100" src="{{asset('img/bg1.png')}}" style="max-width: 100%" alt=""></div>
                <div class="col-12 col-sm-6 col-md-4"><img class="h-100" src="{{asset('img/bg2.png')}}" style="max-width: 100%" alt=""></div>
                <div class="col-12 col-sm-6 col-md-4"><img class="h-100" src="{{asset('img/bg3.png')}}" style="max-width: 100%" alt=""></div>
            </div>
        </div>
    </div>

    <div class="eventos-detalles">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2 class="titulo mb-3">{{(App::getLocale() == 'en') ? 'Build your experience' : 'Arma tu Experiencia'}}</h2>
                    <p>
                        <span class="font-weight-bold">Whatsapp</span> <a href="tel:+529995721178">999 572 1178</a> <br>
                        <span class="font-weight-bold">Correo</span> <a href="mailto:amatexperiencia@gmail.com">amatexperiencia@gmail.com</a> <br>
                        <span class="font-weight-bold">Instagram</span> <a href="https://www.instagram.com/amateexperiences/" target="_blank" rel="noopener noreferrer">@amateexperiences</a>
                    </p>
                </div>
                <div class="col-12 col-md-6">

                    @if (App::getLocale() == 'en')

                        <p class="font-weight-bold">We have a team specialized in creating experiences.</p>

                        <p>Our mission is to provide the best service and go beyond expectations. Whatever the idea, we land it: proposals, birthdays, anniversaries, private groups, special occasions and much more. </p>
                        
                        
                        <p>If you are looking to organize your vacation with different experiences, we design the best itinerary with personalized tours, so that you get to know the places you want to visit, at your own pace and with the people you love. </p>
                        
                        <p>Contact us, we will be happy to accompany you in your special moments and create unforgettable memories.</p>
                    @else                   
    
                        <p class="font-weight-bold">Contamos con un equipo especializado en crear experiencias.</p>
    
                        <p>Nuestra misión es brindar el mejor servicio e ir más allá de las expectativas. Cualquiera que sea la idea, nosotros la aterrizamos: pedidas de mano, cumpleaños, aniversarios, grupos privados, ocasiones especiales y mucho más. </p>
                        
                        
                        <p>Si buscas organizar tu vacación con diferentes experiencias, nosotros diseñamos el mejor itinerario con tours personalizados, para que conozcas los lugares que deseas visitar, a tu ritmo y con las personas que amas. </p>
                        
                        <p>Contáctanos, estaremos felices de acompañarte en tus momentos especiales y crear recuerdos inolvidables.</p>
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