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
                        {{-- <h3 class="mb-0">Light table</h3> --}}
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive pb-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="status">ID</th>
                                <th scope="col" class="sort" data-sort="status">Folio</th>
                                <th scope="col" class="sort" data-sort="status">Evento</th>
                                <th scope="col" class="sort" data-sort="status">Cliente</th>
                                <th scope="col" class="sort" data-sort="status">Correo</th>
                                <th scope="col" class="sort" data-sort="status">Teléfono</th>
                                <th scope="col" class="sort" data-sort="status">No. boletos</th>
                                <th scope="col" class="sort" data-sort="status">Método Pago</th>
                                <th>Estatus Orden</th>
                                <th scope="col" class="sort" data-sort="status">Fecha Creación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @if ((isset($data)) && (count($data) > 0))
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{$row -> id}}</td>
                                        <td>{{$row -> folio}}</td>
                                        <td>{{ $row->evento_titulo }}</td>
                                        <td>{{ $row->nombre_completo }}</td>
                                        <td>{{ $row->correo }}</td>
                                        <td>{{ $row->telefono }}</td>
                                        <td>{{ $row->no_boletos }}</td>
                                        <td>{!! $row->status_string !!}</td>
                                        <td>{{ $row->pago_metodo }}</td>
                                        <td>{{ $row->fecha_string }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('panel.orden.edit', ['id' => $row->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                           {{-- @if (Auth::guard('web')->user()->role == 'admin')--}}
                                                {{--<div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('panel.orden.edit', ['id' => $row->id]) }}">Editar</a>
                                                        <a class="dropdown-item btn-delete" data-axios-method="delete" data-route="{{ route('panel.orden.destroy', ['id' => $row->id]) }}" data-action="location.reload()" href="javascript:;">Eliminar</a>
                                                    </div>
                                                </div>--}}
                                         {{--   @endif--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
