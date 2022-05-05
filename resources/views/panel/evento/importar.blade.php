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
                        <h6 class="heading-small text-muted mb-4">Importar Excel</h6>
                    </div>
                    <!-- Light table -->
                    <div class="card-body">
                        <form action="{{ route('panel.evento.lugares.import', ['evento_id' =>$evento_id]) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}       <div class="card shadow">
                                <div class="card-body">
                                    <div class="col-lg-12 mb-3">
                                        <div class="custom-file @error('excel') invalid @enderror">
                                            <input type="file" name="excel" class="filestyle" data-text="Seleccionar archivo" id="excel" accept=".csv">
                                        </div>
                                        <p> <b>Solo se aceptan formatos .csv para importar</b> </p>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        {{-- @if (Auth::guard('web')->user()->role == 'admin')--}}
                                        <button class="btn btn-default">Importar</button>
                                        {{-- @endif--}}
                                    </div>
                                    <div class="col-lg-12 mt-5">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Folio</th>
                                                    <th>Número</th>
                                                    <th>Letra</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $d)
                                                    <tr>
                                                        <td scope="row">{{$d->rel_id}}</td>
                                                        <td>{{$d->folio}}</td>
                                                        <td>{{$d->num}}</td>
                                                        <td>{{$d->letra}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
