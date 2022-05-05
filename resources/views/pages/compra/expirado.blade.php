@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="section pago">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 text-center">
                    <h1>
                        <b>EL TIEMPO DE LA SESIÓN SE HA AGOTADO</b> <br>
                        <a class="btn btn-primary rounded-pill" href="{{route('front.eventos')}}">IR A LOS EVENTOS</a>
                    </h1>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush