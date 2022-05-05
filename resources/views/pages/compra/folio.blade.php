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
                        <b>CONSULTA DEL FOLIO:</b> <br>
                        <span>{{$busqueda}}</span>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <div class="card">
                        @if($exists)
                            <div class="card-body">
                                <h5 class="card-title mb-2"><b>DATOS DEL CLIENTE</b></h5>
                                <p class="card-text">
                                    Nombre: {{$orden -> nombre_completo}} <br>
                                    Correo: {{$orden -> correo}} <br>
                                    Telefono: {{$orden -> telefono}}
                                </p>
                                <h5 class="card-title mb-2"><b>Evento: {{$evento -> titulo}}</b></h5>
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
                                <h5>ESTE FOLIO NO FUE ENCONTRADO</h5>
                                <p class="card-text">Si tienes algun problema con tu folio, envianos un mensaje al correo <a href="mailto:informes@estom.mx">informes@estom.mx</a></p>
                            </div>
                        @endif

                    </div>
                    <p class="mt-5 text-center">
                        @if($exists)
                        <a class="btn btn-success rounded-pill" href="{{route('front.boleto.download', ['orden_id'=>$orden -> id])}}">DESCARGAR BOLETOS</a>
                        @endif
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