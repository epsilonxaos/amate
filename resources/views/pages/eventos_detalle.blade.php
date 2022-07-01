@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{ asset('plugins/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/pages/eventos.css') }}">
@endpush
@section('contenido')
    <section class="eventos">
        <div class="eventos-galeria pt-3">
            <div class="container-fluid w15">
                @if (count($galeria) > 0)
                    <div class="swiper-container" id="swiperSlide">
                        <div class="swiper-wrapper">
                            @foreach ($galeria as $item)
                                <div class="swiper-slide position-relative">
                                    <img src="{{ asset('storage/evento/galeria/'.$item -> imagen) }}" alt="galeria">

                                    @if ($item -> url)
                                        <div class="video position-absolute d-flex align-items-center justify-content-center" style="top: 0; left:0; width: 100%; height: 100%; background-color: #00000033">
                                            <a data-fancybox href="{{$item -> url}}">
                                                <img src="{{asset('images/play-button.png')}}" alt="play" style="width: 128px; height: auto">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>                    
                @else
                    <img src="{{asset('storage/evento/'.$evento -> portada)}}" alt="{{$evento -> titulo}}" class="w-100" style="height: 80vh; object-fit: cover">
                @endif
            </div>
        </div>


        <div class="eventos-detalle pt-5">
            <div class="container-fluid w12">
                <div class="row justify-content-center">
                    <div class="col-12 text-center mb-5">
                        <h2 class="titulo mb-3">{{$evento -> titulo}}</h2>
                        <p class="mb-4">{!! $evento -> descripcion !!}</p>


                        <form action="{{$evento -> tipo == 0 ? route('front.eventos.boletos') : route('front.eventos.butacas')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="evento_id" value="{{$evento -> id}}">

                            <p class="date text-center">{{$evento -> lugar}}</p>

                            @if (count($horarios) > 1)
                                <input type="hidden" name="horario_id" id="horario_id" value="{{$horarios[0] -> id}}">
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <select name="dia" id="dia" class="form-control">
                                            @foreach ($horarios as $num => $item)
                                                <option value="{{$item -> id}}" {{$num === 0 ? 'selected' : ''}}>{{App\Helpers::dateSpanishComplete($item -> fecha)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <select name="horario" id="horario" class="form-control">
                                            @foreach ($horarios[0] -> horas_list as $num => $item)
                                                <option value="{{$item -> id}}" {{$num === 0 ? 'selected' : ''}}>{{$item -> hora}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                @if (isset($horarios))
                                    <input type="hidden" name="dia" value="{{$horarios[0] -> fecha}}">
                                    <input type="hidden" name="horario" value="{{$horarios[0] -> hora}}">
                                    <input type="hidden" name="horario_id" id="horario_id" value="{{$horarios[0] -> id}}">

                                    <p class="date mb-0">{{App\Helpers::dateSpanishComplete($horarios[0] -> fecha)}}</p>
                                    <p class="date">{{App\Helpers::dateTo12Hrs($horarios[0] -> hora)}}</p>

                                @endif
                            @endif
                            
                            @if (count($precios) > 0)
                                <button type="submit" class="btn btn-gold">¡Quiero ir!</button>
                            @endif
                        </form>

                    </div>
                    <div class="col-12 {{($evento -> imagen_lateral_1 || $evento -> imagen_lateral_2 || $evento -> imagen_lateral_3) ? 'col-md-6' : 'col-md-11'}}">
                        <div class="information-extra">
                            {!! $evento -> descripcion_2 !!}
                        </div>
                    </div>
                    @if ($evento -> imagen_lateral_1 || $evento -> imagen_lateral_2 || $evento -> imagen_lateral_3)
                        <div class="col-12 col-md-6">
                            @if ($evento -> imagen_lateral_1) <img class="mb-2 w-100" src="{{asset($evento -> imagen_lateral_1)}}" alt="{{$evento -> titulo}}"> @endif
                            @if ($evento -> imagen_lateral_2) <img class="mb-2 w-100" src="{{asset($evento -> imagen_lateral_2)}}" alt="{{$evento -> titulo}}"> @endif
                            @if ($evento -> imagen_lateral_3) <img class="mb-2 w-100" src="{{asset($evento -> imagen_lateral_3)}}" alt="{{$evento -> titulo}}"> @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- <div class="container">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="eventos-portada">
                    <img src="{{asset('storage/evento/'.$evento->portada)}}" class="w-100" alt="">
                </div>
            </div>
        </div> --}}
        {{-- <form action="{{$evento -> tipo == 0 ? route('front.eventos.boletos') : route('front.eventos.butacas')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="evento_id" value="{{$evento -> id}}">


            <div class="eventos-informacion-1">
                <div class="container text-center">
                    <h5 class="m30">{{$evento -> titulo}}</h5>
                    @if (count($horarios) > 1)
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Selecciona el día</label>
                                <select class="sl" name="dia" id="dia" required>
                                    <option value="">Selecciona el día</option>
                                    @foreach ($horarios as $h)
                                    <option value="{{$h->fecha}}">{{\App\Http\Controllers\FrontController::ParseDate($h -> fecha)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Selecciona la hora</label>
                                <select class="sl"  name="horario" id="horario" required>
                                    <option value="">Selecciona el horario de la función</option>
                                </select>
                            </div>
                            <input type="hidden" name="horario_id" value="0">
                        </div>
                        <h4 class="mt-5" id="s_day">---</h4>
                        <p>{{$evento -> lugar}} | <span id="s_hour">--:--</span> hrs</p>
                    @else
                        <input type="hidden" name="horario_id" value="{{$horarios[0]->id}}">
                        <h4>{{\App\Http\Controllers\FrontController::ParseDate($horarios[0]->fecha)}}</h4>
                        <p>{{$evento -> lugar}} | {{date('H:i', strtotime($horarios[0] -> hora))}} hrs</p>
                    @endif
                        <div class="comprar text-center pt-2 pb-5">
                            <button class="btn btn-primary rounded-pill mt-2">Comprar Boleto</button>
                        </div>
                </div>
                <div class="container text-justify mt-5">


                    {!! $evento -> descripcion !!}

                    <div class="m30"></div>

                    <div class="card">
                        <div class="card-body">
                            {!! $evento -> descripcion_2 !!}
                        </div>
                    </div>
                </div>
                <div class="container text-center mt-5">
                    <p>Ubicación: {{$evento -> lugar}}</p>
                    <div id="mapa" class="mt-5"></div>
                </div>
            </div>

            <div class="comprar text-center pt-2 pb-5">
                <button class="btn btn-primary rounded-pill mt-2">Comprar Boleto</button>
            </div>
        </form> --}}
    </section>
@endsection

@push('js')
    <link rel="stylesheet" href="{{asset('plugins/@fancyapps/jquery.fancybox.min.css')}}">
    <script src="{{asset('plugins/@fancyapps/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript">
        const EVENTO_VIEW_DETAIL = true;
        const EHORARIOS = @json($horarios);
    </script>
    <script src="{{ mix('js/pages/eventos.js') }}"></script>
@endpush
