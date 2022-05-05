@extends('layouts.panel.app')
@push('css')
    <link rel="stylesheet" href="{{mix('panel/css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('panel/css/jquery-gmaps-latlon-picker.css')}}"/>
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
                        <form action="{{ route('panel.evento.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Datos generales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Horarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Precios</a>
                                    </li>
                                   {{-- <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Galería</a>
                                    </li>--}}
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-3">
                                                        <div class="custom-file @error('portada') invalid @enderror">
                                                            <input type="file" name="portada" class="filestyle" data-text="Portada" id="portada" accept="image/x-png,image/gif,image/jpeg">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="tipo">Tipo de Evento</label>
                                                            <select class="form-control" id="tipo" name="tipo">
                                                                <option value="0">Solo boletos</option>
                                                                <option value="1">Con seleccion de lugares</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('titulo') invalid @enderror">
                                                            <label class="form-control-label" for="title">Título</label>
                                                            <input type="text" name="titulo" id="title" class="form-control" autocomplete="off" value="{{ old('titulo') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('cupo') invalid @enderror">
                                                            <label class="form-control-label" for="lugar">Lugar</label>
                                                            <input type="text" name="lugar" id="lugar" class="form-control" autocomplete="off" value="{{ old('lugar') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset class="gllpLatlonPicker">
                                                            <legend style="margin: 0;padding-top: 20px;padding-bottom: 20px;text-align: center;"><small>Arrastre el pin a la ubicación del evento ó utilice el buscador</small></legend>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="inputGroup-sizing-default">Buscar</span>
                                                                </div>
                                                                <input type="text" class="form-control gllpSearchField" name="buscar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-primary gllpSearchButton" type="button" id="button-addon2">Go</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div id="MAPS" class="col-sm-12 ">
                                                                    <div class="gllpMap" style="width: 100%!important;height: 350px;" >Google Maps</div>
                                                                    <input name="latitud" type="hidden" class="gllpLatitude" value="{{old('latitud') ? old('latitud') : 20.980870}}" />
                                                                    <input name="longitud" type="hidden" class="gllpLongitude" value="{{old('longitud') ? old('longitud') : -89.624032}}"/>
                                                                    <input type="hidden" class="gllpZoom" value="12"/>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion">Descripción</label>
                                                            <textarea name="descripcion" rel="summer" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion_2') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion_2">Descripción 2</label>
                                                            <textarea name="descripcion_2" rel="summer" id="descripcion_2" class="form-control">{{ old('descripcion_2') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-danger add-horario"><i class="fa fa-plus-circle"></i> Agregar Horarios</button>
                                                        <div id="content-horario" class="row">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-danger add-precio"><i class="fa fa-plus-circle"></i> Agregar Precios</button>
                                                        <div id="content-precio" class="row">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                            <div class="col-lg-12">
                                                <div class="custom-file">
                                                    <input type="file" name="galeria[]" multiple class="filestyle" data-text="Galeria" id="galeria" accept="image/x-png,image/gif,image/jpeg">
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
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBuu1Q0hHmlO30h7YRDZ0mWYof-SM-edns" type="text/javascript"></script>
    <script src="{{asset('panel/js/jquery-gmaps-latlon-picker.js')}}"></script>
    <script>
        $(function(){
            cargarMapa();
        })
    </script>
    <script data-template="add_horario" type="text/template">
        <div class="col-md-6 col-sm-12 mt-5" id="new-content-{id}">
            <input type="hidden" name="new_content_id[]" value="{id}">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Horario <button type="button" class="btn btn-dark btn-sm float-right"><i class="fa fa-trash"></i></button>
                </div>
                <div class="card-body" style="background-color: #e9f5fd">
                    <div class="form-group">
                        <label class="form-control-label" for="fecha-dia-{id}">Día</label>
                        <input type="date" name="fecha-dia[{id}]" id="fecha-dia-{id}" class="form-control" autocomplete="off" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="fecha-hora-{id}">Hora</label>
                        <input type="hour" name="fecha-hora[{id}]" id="fecha-hora-{id}" class="form-control" autocomplete="off" value="">
                    </div>
                </div>
            </div>
        </div>

    </script>
    <script data-template="add_precio" type="text/template">
        <div class="col-md-6 col-sm-12 mt-5" id="new-content-precio-{id}">
            <input type="hidden" name="new_content_precio_id[]" value="{id}">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Precio <button type="button" class="btn btn-dark btn-sm float-right"><i class="fa fa-trash"></i></button>
                </div>
                <div class="card-body" style="background-color: #e9f5fd">
                    <div class="form-group">
                        <label class="form-control-label" for="precio-concepto-{id}">Concepto</label>
                        <input type="text" name="precio-concepto[{id}]" id="precio-concepto-{id}" class="form-control" autocomplete="off" value="">
                    </div>
                    <div class="form-group">
                        <label for="precio-tipo-{id}">Tipo</label>
                        <select class="form-control" id="precio-tipo-{id}" name="precio-tipo[{id}]">
                            <option value="0">Punto de Venta</option>
                            <option value="1">Venta en linea</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="precio-costo-{id}">Costo</label>
                        <input type="text" name="precio-costo[{id}]" id="precio-costo-{id}" class="form-control calc-comision" data-id="{id}" data-origin="" autocomplete="off" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="precio-comision-{id}">% Comisión</label>
                        <input type="text" name="precio-comision[{id}]" id="precio-comision-{id}" class="form-control calc-comision" data-id="{id}" data-origin="" autocomplete="off" value="">
                    </div>
                    <div class="totales">
                        Precio Final: <span>$<b id="precio-final-{id}">0.00</b></span>
                    </div>
                </div>
            </div>
        </div>
    </script>
@endpush
