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
        <div class="container">

            <h2 class="titulo mb-3">{{(App::getLocale() == 'en') ? 'Reservations' : 'Reservaciones'}}</h2>
    
            @if (App::getLocale() == 'en')
                <p>Reservations are made through our website or at the reception of the hotels that work with us. Reservations must be made at least 24 hours
                    before the experience. It is not possible to book an experience less than 24 hours in advance.</p>
            @else
                <p>Las reservas se realizan a través de nuestra página web o en la recepción de los hoteles que trabajan con nosotros. Las reservas tienen que realizarse mínimo 24 horas
                    antes de la experiencia. No es posible reservar una experiencia menos de 24 horas antes.</p>
            @endif
        </div>
    </div>
    <div class="eventos-detalle pt-5" id="cancelaciones">
        <div class="container">

            <h2 class="titulo mb-3">{{(App::getLocale() == 'en') ? 'Cancelation' : 'Cancelaciones'}}</h2>
    
            @if (App::getLocale() == 'en')
                <p>It is possible to cancel the reservation with a minimum of 48 hours before the day of the experience. Cancellations made more than 48 hours before reservations will be charged
                    a 15% commission. Cancellations made with less than 48 hours will not be refundable. The refund can take from 4 to 20 days depending on the provider of the
                    customer card.</p>
            @else
                <p>Es posible cancelar la reserva con un mínimo de 48 horas antes del día de la experiencia. A las cancelaciones realizadas más de 48 horas antes de la reservas, se le cobrará
                    una comisión del 15%. Cancelaciones realizadas con menos de 48 horas no serán reembolsables. El rembolso puede tardar de 4 a 20 días de acuerdo al proveedor de la
                    tarjeta del cliente.</p>
            @endif
        </div>
    </div>
@endsection

@push('js')
    @if (Request::get('cancelaciones') == 1)
        <script>
            $('html, body').animate({
                scrollTop: $("#cancelaciones").offset().top
            }, 100);
        </script>
    @endif
@endpush