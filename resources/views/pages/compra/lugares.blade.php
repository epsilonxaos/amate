@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/lugares.css')}}">
@endpush
@section('contenido')
    <section class="section lugares">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-5 text-center">
                    <nav class="nav mb-5">
                        <a class="nav-link active" href="#">PASO 1</a>
                    </nav>
                    <div class="countdown">
                        <h5 class="text-center">Tiempo restante para completar la compra:</h5>
                        <div class="text-center" data-countdown="{{\App\Http\Controllers\FrontController::sumMinutes($orden -> created_at)}}" id="getting-started"></div>
                    </div>
                    <p class="text-center mt-5 mb-5">Porfavor selecciona los asientos que deseas</p>
                </div>
            </div>
            <div class="col-12">
                @include('pages.component.butacas')
                <div class="footer-svg mt-5">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <img src="{{asset('img/icons/asiento.svg')}}" alt="">
                            <label for="">Disponible</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <img src="{{asset('img/icons/asiento_ocupado.svg')}}" alt="">
                            <label for="">Ocupado</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <img src="{{asset('img/icons/asiento_seleccionado.svg')}}" alt="">
                            <label for="">Seleccionado</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <img src="{{asset('img/icons/asiento_reservado.svg')}}" alt="">
                            <label for="">Restringidos</label>
                        </div>
                    </div>
                </div>
                <div class="comprar text-center mt-4">
                    {{--<a href="{{route('front.eventos.comprar', ['id' => $original_id, 'titulo' => $url_amigable])}}" class="btn btn-blanco-negro text-uppercase">Comprar boletos</a>--}}
                    {{--<a href="{{route('front.eventos.pago')}}" class="btn btn-primary rounded-pill mt-2">Continuar</a>--}}
                    <form id="form-asientos" action="{{route('front.eventos.asignacion.lugares')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="evento_id" value="{{$evento_id}}">
                        <input type="hidden" name="horario_id" value="{{$horario_id}}">
                        <input type="hidden" name="asientos_selected" value="">
                        <input type="hidden" name="asientos_precio" value="">
                    </form>
                    <button type="button" class="btn btn-primary rounded-pill mt-2 continuar" >Continuar</button>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        var _asientos = {!! json_encode($asientos) !!};
    </script>
    <script src="{{mix('js/pages/asiento.js')}}"></script>
@endpush


