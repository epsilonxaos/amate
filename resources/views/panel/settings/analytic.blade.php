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
                                <h6 class="heading-small text-muted mb-4">SEO GOOGLE ANALYTICS</h6>
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
                        <form action="{{ route('panel.settings.seo.update') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ua_id">* UA-ID</label>
                                            <input type="text" name="ua_id" id="ua_id" class="form-control" required autocomplete="off" value="{{ Setting::get('ua_id') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="xml">Sitemaps</label>
                                            <input type="file" class="form-control" id="file" lang="es" name="xml" accept=".xml">
                                            <small>Actual: <b><a href="{{ asset(Setting::get('xml')) }}" target="_blank">{{ asset(Setting::get('xml')) }}</a></b></small><br>
                                            <small>Sólo se aceptan archivos con extensión <b>.xml</b></small>
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
