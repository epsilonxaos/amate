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
            
            @if (App::getLocale() == 'en')

                <p class="font-weight-bold mb-0">Who is Amate Experiences?</p>
                <p>Amate Experiences seeks to be the bridge between Yucatan, its culture, its roots, and travelers looking for something more than a conventional trip, those looking to enjoy the experience of becoming just another local. Through experiences designed by local people, your trip will become a true adventure of a lifetime.</p>

                <p class="font-weight-bold mb-0">Can I reserve the day before?</p>
                <p>For organizational reasons, all reservations must be confirmed at least 24 hours before the start of the experience. It is not possible to book an experience less than 24 hours in advance.</p>

                <p class="font-weight-bold mb-0">What happens if I booked and can't live the experience?</p>
                <p>Our reservations have the possibility of cancellation. However, a 15% commission will be applied at the time of reimbursement. Cancellations made with less than 48 hours will not be refundable.</p>

                <p class="font-weight-bold mb-0">How will my refund be made?</p>
                <p>The refund will be made directly to the card that was used to reserve the experience. The total experience minus 15% will be refunded. The refund can take from 4 to 20 days depending on the customer's card provider.</p>

                <p class="font-weight-bold mb-0">What do I have to bring?</p>
                <p>Each experience has a description and all the necessary information so that the traveler can prepare in the best way for their experience.</p>

                <p class="font-weight-bold mb-0">Is it mandatory to tip?</p>
                <p>Tipping is not mandatory. However, we do invite the customer to leave a tip if he is happy and satisfied with the service.</p>

            @else
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
            @endif
        </div>
    </div>
@endsection

@push('js')
@endpush