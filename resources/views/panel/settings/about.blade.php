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
                                        <a class="dropdown-item" href="{{ route('settings.seo') }}">General</a>
                                        <a class="dropdown-item" href="{{ route('settings.seo.facebook') }}">Facebook</a>
                                        <a class="dropdown-item" href="{{ route('settings.seo.analytic') }}">Google Analytics</a>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{ route('settings.seo.update') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="table" value="notes">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="preset_file" value="{{ asset(Setting::get('about_hero')) }}" id="fileWithPreview-preset_file">
                                        <div class="custom-file-container fileWithPreview-elms" id="fileWithPreview" data-upload-id="fileWithPreview">
                                            <label>*Hero <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Limpiar">&times;</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name="about_hero" class="custom-file-container__custom-file__custom-file-input" accept=".jpg,.jpeg" aria-label="Escoger archivo">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <small>Medida óptima 1600 * 615 px</small>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="preset_file" value="{{ asset(Setting::get('about_street')) }}" id="fileWithPreviewStreet-preset_file">
                                        <div class="custom-file-container fileWithPreview-elms" id="fileWithPreviewStreet" data-upload-id="fileWithPreviewStreet">
                                            <label>*Imagen 2 <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Limpiar">&times;</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name="about_street" class="custom-file-container__custom-file__custom-file-input" accept=".jpg,.jpeg,.png" aria-label="Escoger archivo">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <small>Medida óptima 700 * 135 px</small>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="preset_file" value="{{ asset(Setting::get('about_mapa')) }}" id="fileWithPreviewMapa-preset_file">
                                        <div class="custom-file-container fileWithPreview-elms" id="fileWithPreviewMapa" data-upload-id="fileWithPreviewMapa">
                                            <label>*Mapa <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Limpiar">&times;</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" name="about_mapa" class="custom-file-container__custom-file__custom-file-input" accept=".jpg,.jpeg,.png,.svg" aria-label="Escoger archivo">
                                                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <small>Medida óptima 405 * 295 px</small>
                                            <div class="custom-file-container__image-preview"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_text_hero">* Subtítulo hero</label>
                                            <input type="text" name="about_text_hero" id="about_text_hero" class="form-control" required autocomplete="off" value="{{ Setting::get('about_text_hero') }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="text-muted">Sección 2</h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_text_1">* Texto 1</label>
                                            <textarea name="about_text_1" class="form-control" id="" cols="30" rows="5" required>{{ Setting::get('about_text_1') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_text_2">* Texto 2</label>
                                            <textarea name="about_text_2" class="trumbowyg-panel" id="" cols="30" rows="5" required>{{ Setting::get('about_text_2') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="text-muted">Sección 3</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_text_3">*Texto 3</label>
                                            <textarea name="about_text_3" class="form-control" id="" cols="30" rows="5">{{ Setting::get('about_text_3') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="text-muted">Sección 4</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_title_map">*Título mapa</label>
                                            <input name="about_title_map" type="text" class="form-control" value="{{ Setting::get('about_title_map') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="about_text_3">*Subtítulo mapa</label>
                                            <textarea name="about_subtitle_map" class="trumbowyg-panel" id="" cols="30" rows="10">{{ Setting::get('about_subtitle_map') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        @if (Auth::guard('web')->user()->role == 'admin')
                                            <button class="btn btn-default">Confirmar</button>
                                        @endif
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