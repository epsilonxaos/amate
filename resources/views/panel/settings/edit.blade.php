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
                        <div class="row">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-4">SEO GENERAL</h6>
                            </div>
                            <div class="col-4 text-right">
                                <div class="dropdown">
                                    <a href="#!" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones</a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                        <a class="dropdown-item" href="{{ route('panel.settings.seo') }}">General</a>
                                        <a class="dropdown-item" href="{{ route('panel.settings.seo.facebook') }}">Facebook</a>
                                        <a class="dropdown-item" href="{{ route('panel.settings.seo.analytic') }}">Google Analytics</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{ route('panel.settings.seo.update') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="table" value="notes">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="meta-autor">* Meta autor</label>
                                            <input type="text" name="meta-autor" id="meta-autor" class="form-control" required autocomplete="off" value="{{ Setting::get('meta-autor') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="meta-keywords">* Palabras clave</label>
                                            <input type="text" name="meta-keywords" id="meta-keywords" class="form-control" data-role="tagsinput" required autocomplete="off" value="{{ Setting::get('meta-keywords') }}">
                                            <small class="text-muted form-help-text">Separar palabras por comas.</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">* Descripción</label>
                                            <textarea name="description" class="form-control" id="" cols="30" rows="5" required>{{ Setting::get('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="meta-code">Código</label>
                                            <textarea name="meta-code" class="form-control" id="" cols="30" rows="5">{{ Setting::get('meta-code') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dropzone-avatar" class="form-control-label">*Favicon</label>
                                            <input class="form-control unfocus" type="text" name="favicon" id="favicon" value="{{ (old('favicon')) ? old('favicon') : Setting::get('favicon') }}" data-asset="{{ asset('') }}" required>
                                            <a href="#modal-media" data-dropzone="image" data-toggle="modal" data-target="#modal-media" class="btn btn-default float-right mt-1">Escoger del multimedia</a>
                                            <div id="dropzone-avatar" data-route="{{ route('images.store') }}" data-target="#avatar" class="dropzone" style="border:0px">
                                                <div class="dz-default dz-message">Seleccionar archivo</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dropzone-avatar" class="form-control-label">*Imagen para compartir</label>
                                            <input class="form-control unfocus" type="text" name="image_share" id="image_share" value="{{ (old('image_share')) ? old('image_share') : Setting::get('image_share') }}" data-asset="{{ asset('') }}" required>
                                            <a href="#modal-media" data-dropzone="image" data-toggle="modal" data-target="#modal-media" class="btn btn-default float-right mt-1">Escoger del multimedia</a>
                                            <div id="dropzone-avatar" data-route="{{ route('images.store') }}" data-target="#avatar" class="dropzone" style="border:0px">
                                                <div class="dz-default dz-message">Seleccionar archivo</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <button class="btn btn-default">Confirmar</button>
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