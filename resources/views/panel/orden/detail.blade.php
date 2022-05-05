@extends('layouts.panel.app')
@section('content')
    <!-- Header -->
    @include('include.panel.header')
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        {{-- <h3 class="mb-0">Nuevo usuario</h3> --}}
                        <h6 class="heading-small text-muted mb-4">Información</h6>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Datos generales</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                        <div class="pl-lg-4">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            DATOS DEL CLIENTE
                                                        </div>
                                                        <div class="card-body">
                                                            <p><b>Nombre:</b> {{$orden -> nombre_completo}} </p>
                                                            <p><b>Correo:</b> {{$orden -> correo}}</p>
                                                            <p><b>Teléfono:</b> {{$orden -> telefono}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            DATOS DEL EVENTO
                                                        </div>
                                                        <div class="card-body">
                                                            <p><b>Folio:</b> {{$orden -> folio}}</p>
                                                            <p><b>Evento:</b> {{$orden -> evento_titulo}}</p>
                                                            <p><b>Dia:</b> {{$orden -> fecha_string}}</p>
                                                            <p><b>Hora:</b> {{$orden -> hora}}</p>
                                                            <p><b>No. boletos:</b> {{count($orden->asientos)}}</p>
                                                            {{--<p><b>Asientos:</b> {{$orden -> asientos_string}}</p>--}}
                                                            <div class="row justify-content-center">
                                                                @foreach($orden -> asientos as $s)
                                                                <div class="col-md-4 col-sm-12">
                                                                    <div class="card w-100 text-center">
                                                                        <div class="card-body">
                                                                            <center>
                                                                                {{--{!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($s -> folio); !!}--}}
                                                                                <img src="data:image/svg+xml;base64, {{ base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($s -> folio)) }}" alt="">
                                                                            </center>
                                                                            <p class="mt-2">Folio: {{$s -> folio}} - {{$s -> letra}}{{$s -> num}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                <div class="col-12">
                                                                <a href="{{route('panel.orden.download', ['orden_id'=>$orden -> id])}}" class="btn btn-success">DESCARGAR BOLETOS</a>
                                                                    <a href="{{route('panel.orden.download.preview', ['orden_id'=>$orden -> id])}}" class="btn btn-success">DESCARGAR PREVIEW BOLETOS</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            DATOS DE LA ORDEN
                                                        </div>
                                                        <div class="card-body">
                                                            <p><b>Metodo de pago:</b> {{$orden -> metodo_pago}}</p>
                                                            <p><b>Fecha de pago:</b> {{$orden -> pago_hora_string}}</p>
                                                            <p><b>Estatus de pago:</b> {!! $orden -> status_string !!}</p>
                                                            <p><b>Error de pago:</b> {{$orden -> pago_error}}</p>
                                                            <p><b>Codigo de referencia de pago:</b> {{$orden -> pago_referencia}}</p>
                                                            <p><b>Subtotal:</b> ${{$orden -> subtotal}}</p>
                                                            <p><b>Descuento:</b> - ${{$orden -> descuento}}</p>
                                                            <p><b>Total:</b> {{$orden -> total}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

