@extends('layouts.panel.app')
@push('css')
    <link rel="stylesheet" href="{{mix('panel/css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
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
                        <form action="{{ route('panel.cupon.update', ['id' => $cupon -> id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
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
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('titulo') invalid @enderror">
                                                            <label class="form-control-label" for="title">Título</label>
                                                            <input type="text" name="titulo" id="title" class="form-control" autocomplete="off" value="{{ old('titulo') ? old('titulo') : $cupon -> titulo }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('fecha_inicio') invalid @enderror">
                                                            <label class="form-control-label" for="fecha_inicio">Fecha Inicio</label>
                                                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" autocomplete="off" value="{{ old('fecha_inicio') ? old('fecha_inicio') : $cupon -> fecha_inicio }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('fecha_termino') invalid @enderror">
                                                            <label class="form-control-label" for="fecha_termino">Fecha Termino</label>
                                                            <input type="date" name="fecha_termino" id="fecha_termino" class="form-control" autocomplete="off" value="{{ old('fecha_termino') ? old('fecha_termino') : $cupon -> fecha_termino }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('fecha_termino') invalid @enderror">
                                                            <label class="form-control-label" for="tipo">Tipo de descuento</label>
                                                            <select name="tipo" id="tipo" class="form-control" required>
                                                                <option {{ old('tipo') == 1 ? 'selected' : $cupon -> tipo == 1 ? 'selected' : '' }} value="1">Efectivo</option>
                                                                <option {{ old('tipo') == 2 ? 'selected' : $cupon -> tipo == 2 ? 'selected' : '' }} value="2">Porcentaje</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descuento') invalid @enderror">
                                                            <label class="form-control-label" for="descuento">Descuento</label>
                                                            <input type="text" name="descuento" id="descuento" class="form-control" autocomplete="off" value="{{ old('descuento') ? old('descuento') : $cupon -> descuento }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('limite') invalid @enderror">
                                                            <label class="form-control-label" for="limite">Limite Uso</label>
                                                        <input type="text" name="limite" id="limite" class="form-control" autocomplete="off" value="{{ old('limite') ? old('limite') : $cupon -> limite }}">
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
                                        <button class="btn btn-default">Confirmar</button>
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
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endpush
