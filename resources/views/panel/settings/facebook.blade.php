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
                                <h6 class="heading-small text-muted mb-4">SEO FACEBOOK</h6>
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
                        <form action="{{ route('panel.settings.seo.update') }}" method="POST" class="needs-validation" novalidate>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="table" value="notes">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="og-title">* Título</label>
                                            <input type="text" name="og-title" id="og-title" class="form-control" required autocomplete="off" value="{{ Setting::get('og-title') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="app_url">* URL del Sitio</label>
                                            <input type="text" name="app_url" id="app_url" class="form-control" required autocomplete="off" value="{{ Setting::get('app_url') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="og-description">* Descripción</label>
                                            <textarea name="og-description" class="form-control" id="" cols="30" rows="5" required>{{ Setting::get('og-description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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