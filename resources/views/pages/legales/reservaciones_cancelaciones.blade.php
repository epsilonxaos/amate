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

            <h2 class="titulo mb-3">Reservaciones</h2>
    
            <p>Las reservas se realizan a través de nuestra página web o en la recepción de los hoteles que trabajan con nosotros. Las reservas tienen que realizarse mínimo 24 horas
                antes de la experiencia. No es posible reservar una experiencia menos de 24 horas antes.</p>
        </div>
    </div>
    <div class="eventos-detalle pt-5" id="cancelaciones">
        <div class="container">

            <h2 class="titulo mb-3">Cancelaciones</h2>
    
            <p>Es posible cancelar la reserva con un mínimo de 48 horas antes del día de la experiencia. A las cancelaciones realizadas más de 48 horas antes de la reservas, se le cobrará
                una comisión del 15%. Cancelaciones realizadas con menos de 48 horas no serán reembolsables. El rembolso puede tardar de 4 a 20 días de acuerdo al proveedor de la
                tarjeta del cliente.</p>
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