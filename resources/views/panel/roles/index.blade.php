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
                                <th width="20px">
                                </th>
                                <th scope="col" class="sort" data-sort="status">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @if ((isset($data)) && (count($data) > 0))
                                @foreach ($data as $row)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="" id=""><span style="opacity:0;">{{ $row->id}}</span>
                                        </td>
                                        <td>{{ $row->name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('panel.roles.edit', ['id' => $row->id]) }}">Editar</a>
                                                    <a class="dropdown-item btn-delete" data-axios-method="delete" data-route="{{ route('panel.roles.destroy', ['id' => $row->id]) }}" data-action="location.reload()" href="javascript:;">Eliminar</a>
                                                </div>
                                            </div>
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
