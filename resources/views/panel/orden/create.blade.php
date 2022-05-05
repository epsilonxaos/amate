@extends('layouts.panel.app')
@push('css')
    <link rel="stylesheet" href="{{mix('panel/css/app.css')}}">
@endpush
@section('content')
    <!-- Header -->
    @include('include.panel.header')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        {{-- <h3 class="mb-0">Nuevo usuario</h3> --}}
                        <h6 class="heading-small text-muted mb-4">Vender Boletos</h6>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{route('panel.orden.store')}}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h2><span class="badge badge-danger badge-circle badge-lg">1</span> Datos del evento</h2>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="evento_id">Selecciona el evento</label>
                                                        <select class="form-control" id="evento_id" name="evento_id" required>
                                                            <option value="">Seleccionar evento</option>
                                                            @foreach($eventos as $ev)
                                                                <option data-evento="{{json_encode($ev)}}" value="{{$ev -> id}}">{{$ev -> titulo}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="horario_id">Selecciona el horario</label>
                                                        <select class="form-control" id="horario_id" name="horario_id" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="precio_id">Selecciona el tipo de boleto</label>
                                                        <select class="form-control" id="precio_id" name="precio_id" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group @error('no_boletos') invalid @enderror">
                                                        <label class="form-control-label" for="no_boletos">Cantidad de Boletos </label>
                                                        <input type="number" name="no_boletos" id="no_boletos" class="form-control" autocomplete="off" value="{{ old('no_boletos') ? old('no_boletos') : '1'  }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h2><span class="badge badge-danger badge-circle badge-lg">2</span> Datos del comprador</h2>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group @error('customer_name') invalid @enderror">
                                                        <label class="form-control-label" for="customer_name">Nombre </label>
                                                        <input type="text" name="customer_name" id="customer_name" class="form-control" autocomplete="off" value="{{ old('customer_name') ? old('customer_name') : ''  }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group @error('customer_phone') invalid @enderror">
                                                        <label class="form-control-label" for="customer_phone">Telefono </label>
                                                        <input type="text" name="customer_phone" id="customer_phone" class="form-control" autocomplete="off" value="{{ old('customer_phone') ? old('customer_phone') : ''  }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group @error('customer_email') invalid @enderror">
                                                        <label class="form-control-label" for="customer_email">Correo </label>
                                                        <input type="email" name="customer_email" id="customer_email" class="form-control" autocomplete="off" value="{{ old('customer_email') ? old('customer_email') : ''  }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h2><span class="badge badge-danger badge-circle badge-lg">3</span> Cupón de descuento</h2>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Ingrese el cupon" name="cupon" aria-describedby="button-addon2">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary apply-cupon" type="button" id="button-addon2">Validar</button>
                                                            <input type="hidden" name="cupon_tipo" value="0">
                                                            <input type="hidden" name="cupon_valor" value="0">
                                                            <input type="hidden" name="descuento" value="0">
                                                            <input type="hidden" name="evento_titulo" value="">
                                                            <input type="hidden" name="subtotal" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h2><span class="badge badge-danger badge-circle badge-lg">4</span> Resumen de compra</h2>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Evento: <span id="evento_titulo"></span></h4>
                                                            <p>
                                                                Día: <span id="evento_dia"></span>  <br>
                                                                Hora: <span id="evento_hora"></span>  hrs <br>
                                                                Ubicacion: <span id="evento_ubicacion"></span>  <br>
                                                                Número de boletos:  <span id="evento_boletos"></span> <br>
                                                            </p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <p>Subtotal <label class="float-right">$ <span id="s_subtotal"></span> MXN</label> </p>
                                                            <p>Descuento <label class="float-right" >-$ <span id="s_descuento">0.00</span> MXN</label></p>
                                                            <p>Total <label class="float-right">$ <span id="s_total"></span> MXN</label></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <h2><span class="badge badge-danger badge-circle badge-lg">5</span> Metodo Pago</h2>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="metodo_pago">Selecciona el tipo de boleto</label>
                                                            <select class="form-control" id="metodo_pago" name="metodo_pago" required>
                                                                <option value="efectivo">Efectivo</option>
                                                                <option value="tarjeta">Tarjeta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        {{-- @if (Auth::guard('web')->user()->role == 'admin')--}}
                                        <button class="btn btn-default">Completar Venta</button>
                                        {{-- @endif--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
