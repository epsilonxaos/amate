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
                        <form action="{{ route('panel.evento.update', ['id' => $evento -> id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
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
                                                    <div class="col-lg-2 offset-lg-4">
                                                        <div class="card">
                                                            <img class="card-img-top" src="{{asset('storage/evento/'.$evento -> portada)}}" alt="Card image cap">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="custom-file @error('portada') invalid @enderror">
                                                            <input type="file" name="portada" class="filestyle" data-text="Portada" id="portada" accept="image/x-png,image/gif,image/jpeg">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="tipo">Tipo de Evento</label>
                                                            <select class="form-control" id="tipo" name="tipo">
                                                                <option value="0" {{$evento -> tipo == 0 ? 'selected' : '' }} >Solo boletos</option>
                                                                <option value="1" {{$evento -> tipo == 1 ? 'selected' : '' }} >Con seleccion de lugares</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('titulo') invalid @enderror">
                                                            <label class="form-control-label" for="title">Título</label>
                                                            <input type="text" name="titulo" id="title" class="form-control" autocomplete="off" value="{{ old('titulo') ? old('titulo') : $evento -> titulo  }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('lugar') invalid @enderror">
                                                            <label class="form-control-label" for="lugar">Lugar</label>
                                                            <input type="text" name="lugar" id="lugar" class="form-control" autocomplete="off" value="{{ old('lugar') ? old('lugar') : $evento -> lugar  }}">
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
                                                                    <input name="latitud" type="hidden" class="gllpLatitude" value="{{old('latitud') ? old('latitud') : $evento -> latitud}}" />
                                                                    <input name="longitud" type="hidden" class="gllpLongitude" value="{{old('longitud') ? old('longitud') : $evento -> longitud}}"/>
                                                                    <input type="hidden" class="gllpZoom" value="12"/>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion">Descripción</label>
                                                            <textarea name="descripcion" rel="summer" id="descripcion" class="form-control">{{ old('descripcion') ? old('descripcion') : $evento -> descripcion }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion_2') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion_2">Descripción 2</label>
                                                            <textarea name="descripcion_2" rel="summer" id="descripcion_2" class="form-control">{{ old('descripcion_2') ? old('descripcion_2') : $evento -> descripcion_2 }}</textarea>
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
                                                        <div class="row">
                                                            @if(count($evento_horario))
                                                                @foreach($evento_horario as $horario)
                                                                    <div class="col-md-6 col-sm-12 mt-5" id="old-content-{{$horario -> id}}">
                                                                        <input type="hidden" name="old_content_id[]" value="{{$horario -> id}}">
                                                                        <div class="card h-100">
                                                                            <div class="card-header bg-dark text-white">
                                                                                Horario {{--<a class="btn btn-dark btn-sm float-right"><i class="fa fa-trash"></i></a>--}}
                                                                                <label class="custom-toggle float-right">
                                                                                    <input class="update-status" data-axios-method="put" data-route="{{ route('panel.evento.status.horario', ['id' => $horario->id]) }}" type="checkbox" value="1" {{ ($horario->status == 1) ? 'checked' : '' }}>
                                                                                    <span class="custom-toggle-slider rounded-circle"></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="card-body" style="background-color: #e9f5fd">
                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="fecha-dia-upd-{{$horario -> id}}">Dia</label>
                                                                                    <input type="date" name="fecha-dia-upd[{{$horario -> id}}]" id="fecha-dia-upd-{{$horario -> id}}" class="form-control" autocomplete="off" value="{{$horario -> fecha}}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="fecha-hora-upd-{{$horario -> id}}">Hora</label>
                                                                                    <input type="hour" name="fecha-hora-upd[{{$horario -> id}}]" id="fecha-hora-upd-{{$horario -> id}}" class="form-control" autocomplete="off" value="{{$horario -> hora}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
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
                                                        <div class="row">
                                                            @if(count($evento_precio))
                                                                @foreach($evento_precio as $precio)
                                                                    <div class="col-md-6 col-sm-12 mt-5" id="old-content-precio-{{$precio -> id}}">
                                                                        <input type="hidden" name="old_content_precio_id[]" value="{{$precio -> id}}">
                                                                        <div class="card h-100">
                                                                            <div class="card-header bg-dark text-white">
                                                                                Precios
                                                                                <button class="btn btn-danger float-right btn-sm btn-delete" type="button" data-axios-method="delete" data-route="{{ route('panel.evento.precio.destroy', ['id' => $precio->id]) }}" data-action="location.reload()"><i class="fa fa-trash"></i></button>
                                                                                <button class="btn btn-success float-right btn-sm mr-1" data-toggle="modal" type="button" data-target="#modal-asiento" data-id="{{$precio->id}}">Lugares</button>
                                                                            </div>
                                                                            <div class="card-body" style="background-color: #e9f5fd">
                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="precio-concepto-upd-{{$precio -> id}}">Concepto</label>
                                                                                    <input type="text" name="precio-concepto-upd[{{$precio -> id}}]" id="precio-concepto-upd-{{$precio -> id}}" class="form-control" autocomplete="off" value="{{$precio -> concepto}}">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="precio-tipo-upd-{{$precio -> id}}">Tipo</label>
                                                                                    <select class="form-control" id="precio-tipo-upd-{{$precio -> id}}" name="precio-tipo-upd[{{$precio -> id}}]">
                                                                                        <option {{$precio -> tipo == 0 ? 'selected' : ''}} value="0">Punto de Venta</option>
                                                                                        <option {{$precio -> tipo == 1 ? 'selected' : ''}} value="1">Venta en linea</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="precio-costo-upd-{{$precio -> id}}">Precio</label>
                                                                                    <input type="text" name="precio-costo-upd[{{$precio -> id}}]" id="precio-costo-upd-{{$precio -> id}}" class="form-control calc-comision" data-id="{{$precio -> id}}" data-origin="upd" autocomplete="off" value="{{$precio -> precio}}">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label class="form-control-label" for="precio-comision-upd-{{$precio -> id}}">% Comisión</label>
                                                                                    <input type="text" name="precio-comision-upd[{{$precio -> id}}]" id="precio-comision-upd-{{$precio -> id}}" class="form-control calc-comision" data-id="{{$precio -> id}}" data-origin="upd" autocomplete="off" value="{{$precio -> comision}}">
                                                                                </div>
                                                                                <div class="totales">
                                                                                    Precio Final: <span>$<b id="precio-final-upd-{{$precio -> id}}">0.00</b></span>
                                                                                </div>
                                                                                <p>Asientos Asignados: {{\App\Http\Controllers\EventoController::listAsientosPerPrecio($precio->id)}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
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

                                                <div class="col-lg-12 mt-3">
                                                    <div class="row row-cols-1 row-cols-md-4">
                                                @if(count($galeria))
                                                    @foreach($galeria as $k => $gal)
                                                        <div class="col mb-4">
                                                            <div class="card h-100">
                                                                <div class="card-img-top" style="background-image: url({{asset('storage/evento/galeria/'.$gal -> imagen)}}); background-repeat: no-repeat; background-size: contain; background-position: center;">
                                                                    <img height="200px;" style="opacity: 0;" src="{{asset('storage/evento/galeria/'.$gal -> imagen)}}" alt="Card image cap">
                                                                    <button type="button" class="btn btn-danger btn-sm float-right btn-delete" data-axios-method="delete" data-route="{{ route('panel.evento.galeria.destroy', ['id' => $gal->id]) }}" data-action="location.reload()"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                                <input type="hidden" name="galeria_id[]" value="{{$gal->id}}">
                                                                <div class="card-body mx-auto">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="galeria_upd[]" class="filestyle" data-input="false" data-btnClass="btn-primary" data-text="Modificar" accept="image/x-png,image/gif,image/jpeg">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
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
    <div class="modal fade" id="modal-asiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="post" action="{{route('panel.evento.asignar.precio')}}">
                {{csrf_field()}}
                <input type="hidden" name="precio_id" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">Asignar precios a los lugares</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label class="form-control-label" for="companies_id">Selecciona los asientos</label>
                                <select name="asiento_id[]" multiple id="asientos_id" class="form-control selectpicker" data-style="btn-primary" data-live-search="true" data-actions-box="true">
                                    @foreach($evento_asientos  as $asiento)
                                        <option value="{{$asiento->id}}">{{$asiento->num}}{{$asiento->letra}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
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

            $('#modal-asiento').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var precio_id   = button.data('id');
                var form = $('#modal-asiento').find('form');
                form[0].reset();
                $('#modal-asiento').find('input[name=precio_id]').val(precio_id);
            });

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