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
                                <th scope="col" class="sort" data-sort="status">Portada</th>
                                <th width="150px">Publicación</th>
                                <th width="100px">Destacar</th>
                                <th scope="col" width="150px">Acciones</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @if ((isset($data)) && (count($data) > 0))
                                @foreach ($data as $row)
                                    <tr>
                                        <td>
                                            <img src="">
                                            <div class="media align-items-center">
                                                <div class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" style="height: 48px; width: 48px; object-fit: cover;" src="{{asset('storage/evento/'.$row->portada)}}">
                                                </div>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $row->titulo }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input class="update-status" data-axios-method="put" data-route="{{ route('panel.evento.status', ['id' => $row->id]) }}" type="checkbox" value="{{$row->status}}" {{ ($row->status == 1) ? 'checked' : '' }}>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input class="update-status" data-axios-method="put" data-route="{{ route('panel.evento.destacar', ['id' => $row->id]) }}" type="checkbox" value="{{$row->destacado == 1 ? 0 : 1}}" {{ ($row->destacado == 1) ? 'checked' : '' }}>
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('panel.evento.edit', ['id' => $row->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btn-delete" data-axios-method="delete" data-route="{{ route('panel.evento.destroy', ['id' => $row->id]) }}" data-action="location.reload()"><i class="fa fa-trash"></i></button>
                                            {{-- <a href="{{route('panel.evento.lugares', ['id' => $row ->id])}}" class="btn btn-success btn-sm"><i class="fa fa-ticket-alt"></i></a> --}}
                                            {{-- <a href="{{route('panel.evento.export', ['id' => $row ->id])}}"><i class="fa fa-download"></i></a> --}}
                                           {{-- @if (Auth::guard('web')->user()->role == 'admin')--}}
                                                {{--<div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('panel.evento.edit', ['id' => $row->id]) }}">Editar</a>
                                                        <a class="dropdown-item btn-delete" data-axios-method="delete" data-route="{{ route('panel.evento.destroy', ['id' => $row->id]) }}" data-action="location.reload()" href="javascript:;">Eliminar</a>
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
