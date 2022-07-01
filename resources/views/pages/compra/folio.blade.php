@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="section pago">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 text-center">
                    <h1>
                        <b>{{(App::getLocale() == 'en') ? 'CONSULTATION OF THE FOLIO' : 'CONSULTA DEL FOLIO'}}:</b> <br>
                        <span>{{$busqueda}}</span>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <div class="card">
                        @if($exists)
                            <div class="card-body">
                                <h5 class="card-title mb-2"><b>{{(App::getLocale() == 'en') ? 'CLIENT DATA' : 'DATOS DEL CLIENTE'}}</b></h5>
                                <p class="card-text">
                                    {{(App::getLocale() == 'en') ? 'Name' : 'Nombre'}}: {{$orden -> nombre_completo}} <br>
                                    {{(App::getLocale() == 'en') ? 'Email' : 'Correo'}}: {{$orden -> correo}} <br>
                                    {{(App::getLocale() == 'en') ? 'Phone' : 'Telefono'}}: {{$orden -> telefono}}
                                </p>
                                <h5 class="card-title mb-2"><b>{{(App::getLocale() == 'en') ? 'Event' : 'Evento'}}: {{(App::getLocale() == 'en') ? $evento -> titulo_en : $evento -> titulo}}</b></h5>
                                <p class="card-text">
                                    {{(App::getLocale() == 'en') ? 'Day' : 'Día'}}: {{(App::getLocale() == 'en') ? \App\Helpers::dateComplete($orden -> dia) : \App\Helpers::dateSpanishShort($orden -> dia)}} <br>
                                    {{(App::getLocale() == 'en') ? 'Hour' : 'Hora'}}: {{$orden -> hora}} hrs <br>
                                    {{(App::getLocale() == 'en') ? 'Location' : 'Ubicacion'}}: {{$evento -> lugar}} <br>
                                    {{(App::getLocale() == 'en') ? 'Number of tickets' : 'Número de boletos'}}: {{$orden -> no_boletos}}
                            </div>
                            <div class="card-footer" style="background-color: #153D3C">
                                <p>Subtotal <span class="float-right">${{number_format($subtotal, 2)}} MXN</span></p>
                                <p>{{(App::getLocale() == 'en') ? 'Discount' : 'Descuento'}} <span class="float-right">${{number_format($descuento, 2)}}</span></p>
                                <p>Total <span class="float-right">${{number_format($total, 2)}} MXN</span></p>
                            </div>
                            <div class="row justify-content-center">
                                @foreach($asientos as $s)
                                    <div class="col-12 col-md-4">
                                        <div class="content-boleto text-center mt-4">
                                            <img src="data:image/svg+xml;base64, {{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($s -> folio)) }}" alt="">
                                            <p class="text-black-50">FOLIO: <b>{{$s->folio}}</b></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-body text-center">
                                <h5>{{(App::getLocale() == 'en') ? 'THIS PAGE WAS NOT FOUND' : 'ESTE FOLIO NO FUE ENCONTRADO'}}</h5>
                                {{-- <p class="card-text">Si tienes algun problema con tu folio, envianos un mensaje al correo <a href="mailto:helpcenter@casaamate.mx">helpcenter@casaamate.mx</a></p> --}}
                            </div>
                        @endif

                    </div>
                    <p class="mt-5 text-center">
                        @if($exists)
                        <a class="btn btn-gold rounded-pill px-4" target="_blank" href="{{route('front.boleto.download', ['orden_id'=>$orden -> id])}}">{{(App::getLocale() == 'en') ? 'DOWNLOAD' : 'DESCARGAR BOLETOS'}}</a>
                        @endif
                        <a class="btn btn-info rounded-pill px-4 ml-3" href="{{route('front.eventos')}}">{{(App::getLocale() == 'en') ? 'BACK' : 'REGRESAR'}}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        const EVENTO_VIEW_DETAIL = false;
    </script>
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush