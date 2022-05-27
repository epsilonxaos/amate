@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="section pago">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-10 text-center">
                    <h2 class="titulo mb-5">EL TIEMPO DE LA SESIÓN SE HA AGOTADO</h2>
                    <a class="btn btn-gold" href="{{route('front.eventos')}}">Ir a los eventos</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        const EVENTO_VIEW_DETAIL = false;
    </script>
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush