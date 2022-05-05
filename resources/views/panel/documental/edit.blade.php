@extends('layouts.panel.app')
@push('css')
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
                        <form action="{{ route('panel.documental.update', ['id' => $documental -> id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Datos generales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Galería</a>
                                    </li>
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
                                                            <img class="card-img-top" src="{{asset('storage/documental/'.$documental -> portada)}}" alt="Card image cap">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="custom-file @error('portada') invalid @enderror">
                                                            <input type="file" name="portada" class="filestyle" data-text="Portada" id="portada" accept="image/x-png,image/gif,image/jpeg">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('titulo') invalid @enderror">
                                                            <label class="form-control-label" for="title">Título</label>
                                                            <input type="text" name="titulo" id="title" class="form-control" autocomplete="off" value="{{ old('titulo') ? old('titulo') : $documental -> titulo  }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion">Descripción</label>
                                                            <textarea name="descripcion" rel="summer" id="descripcion" class="form-control">{{ old('descripcion') ? old('descripcion') : $documental -> descripcion }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group @error('descripcion_2') invalid @enderror">
                                                            <label class="form-control-label" for="descripcion_2">Descripción 2</label>
                                                            <textarea name="descripcion_2" rel="summer" id="descripcion_2" class="form-control">{{ old('descripcion_2') ? old('descripcion_2') : $documental -> descripcion_2 }}</textarea>
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
                                                                <div class="card-img-top" style="background-image: url({{asset('storage/documental/galeria/'.$gal -> imagen)}}); background-repeat: no-repeat; background-size: contain; background-position: center;">
                                                                    <img height="200px;" style="opacity: 0;" src="{{asset('storage/documental/galeria/'.$gal -> imagen)}}" alt="Card image cap">
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
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
@endpush
