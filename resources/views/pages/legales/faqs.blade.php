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

            <h2 class="titulo mb-3">FAQ’s</h2>
    
            <p class="font-weight-bold mb-0">¿Quien es Amate Experiences?</p>
            <p>Amate Experiences busca ser el puente entre Yucatán, su cultura, sus raíces y los viajeros que buscan algo más que un viaje convencional, aquellos que buscan disfrutar la
            experiencia de convertirse en un local más. A través de experiencias diseñadas de la mano de personas locales, tu viaje se convertirá en una verdadera aventura de vida.</p>

            <p class="font-weight-bold mb-0">¿Puedo reservar el día antes?</p>
            <p>Por cuestiones organizativas, todas las reservas tienen que confirmarse mínimo 24 horas antes del comienzo de la experiencia. No es posible reservar una experiencia
            menos de 24 horas antes.</p>

            <p class="font-weight-bold mb-0">¿Qué pasa si reservé y no puedo vivir la experiencia?</p>
            <p>Nuestras reservas cuentan con la posibilidad de cancelación. Sin embargo, se aplicará una comisión del 15% a la hora del rembolso. Cancelaciones realizadas con menos
            de 48 horas no serán reembolsables.</p>

            <p class="font-weight-bold mb-0">¿Como se hará mi rembolso?</p>
            <p>El rembolso se realizará directamente a la tarjeta que se utilizó para la reserva de la experiencia. Se rembolsará el total de la experiencia menos el 15%. El rembolso puede
            tardar de 4 a 20 días de acuerdo al proveedor de la tarjeta del cliente.</p>

            <p class="font-weight-bold mb-0">¿Qué tengo que llevar?</p>
            <p>Cada experiencia cuenta con una descripción y con toda la información necesaria para que el viajero se pueda preparar de la mejor manera para su experiencia.</p>

            <p class="font-weight-bold mb-0">¿Es obligatorio dejar propina?</p>
            <p>La propina no es obligatoria. Sin embargo, si invitamos al cliente a dejar una propina si se encuentra feliz y satisfecho con el servicio.</p>
        </div>
    </div>
@endsection

@push('js')
@endpush