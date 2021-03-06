@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="section pago">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 text-center">
                    <h1 class="text-dark">
                        <b>FOLIO</b> <br>
                        <span>{{$orden -> folio}}</span>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-5"><b>{{(App::getLocale() == 'en') ? $evento -> titulo_en : $evento -> titulo}}</b></h5>
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
                    </div>
                    <p class="mt-5 text-center text-dark">
                        {{(App::getLocale() == 'en') ? 'This receipt has been sent to your email' : 'Se ha enviado a tu correo este comprobante'}} <br> <br>
                        <a class="btn btn-gold rounded-pill px-4" target="_blank" href="{{route('front.boleto.download', ['orden_id'=>$orden -> id])}}">{{(App::getLocale() == 'en') ? 'DOWNLOAD' : 'DESCARGAR BOLETOS'}}</a>
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