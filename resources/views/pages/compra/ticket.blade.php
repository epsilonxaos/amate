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
                        <b>FOLIO</b> <br>
                        <span>{{$orden -> folio}}</span>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-5"><b>{{$evento -> titulo}}</b></h5>
                            <p class="card-text">
                                Día: {{$fecha}} <br>
                                Hora: {{$orden -> hora}} hrs <br>
                                Ubicacion: {{$evento -> lugar}} <br>
                                Número de boletos: {{count($asientos)}} <br>
                                Asientos: {{\App\Http\Controllers\FrontController::asientosToString($asientos)}}
                            </p>
                        </div>
                        <div class="card-footer">
                            <p>Subtotal <span class="float-right">${{number_format($subtotal, 2)}} MXN</span></p>
                            <p>Descuento <span class="float-right">${{number_format($descuento, 2)}}</span></p>
                            <p>Total <span class="float-right">${{number_format($total, 2)}} MXN</span></p>
                        </div>
                    </div>
                    <p class="mt-5 text-center">
                        Se ha enviado a tu correo este comprobante <br> <br>
                        <a class="btn btn-primary rounded-pill" href="{{route('front.eventos')}}">REGRESAR</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush