@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
@endpush

@section('contenido')
    <div class="section eventos">
        <div class="eventos-slide overflow-hidden position-relative">
            <div class="swiper" id="swiperSlide">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                  <!-- Slides -->
                    @foreach ($destacados as $item)
                        <div class="swiper-slide position-relative">
                            <img src="{{asset('storage/evento/'.$item -> portada)}}" alt="Galeria">

                            <div class="info text-center pl-3 pr-3 pl-md-5 pr-md-5">
                                <h2 class="mb-4">{{(App::getLocale() == 'en') ? $item -> titulo_en : $item -> titulo}}</h2>
                                <a href="{{route('front.eventos.detalle', [$item -> id, $item -> url_amigable])}}" class="btn btn-white fw-500">@lang('eventos.btn_galeria_ir')</a>
                            </div>
                        </div>
                    @endforeach
                  {{-- <div class="swiper-slide">
                      <img src="{{asset('img/slide01.jpg')}}" alt="Galeria">
                  </div>
                  <div class="swiper-slide">
                      <img src="{{asset('img/slide01.jpg')}}" alt="Galeria">
                  </div> --}}
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div class="eventos-informacion position-relative p-0" id="listEventos">

            <div class="bg-verde">
                <h2 class="titulo decoracion text-center d-flex align-items-center justify-content-center w-100 mb-4">@lang('eventos.tlo_exp')</h2>
            </div>

            <div class="container-fluid w12 pt-4 pb-4 {{Request::get('calendario') == 0 ? '' : 'd-none'}}" id="eventosContainer">
                <div class="text-center mb-4">
                    <button class="btn btn-gold toggleEventos">@lang('eventos.btn_ver_calendario')</button>
                </div>
                <div class="row mb-3">
                    @if (count($eventos) > 0)
                        @foreach ($eventos as $evento)
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}">
                                    <div class="eventos-content">
                                        <img src="{{asset('storage/evento/'.$evento -> portada)}}" alt="{{$evento -> titulo}}" class="cover">
                                        <div class="footer text-left p-3">
                                            <h5>{{(App::getLocale() == 'en') ? $evento -> titulo_en : $evento -> titulo}}</h5>
                                            {{-- <h6 class="mb-1">Fecha: {{\App\Helpers::dateSpanishComplete($evento -> fechaEvento)}}</h6> --}}
                                            @if (isset($evento -> precioEvento) && ($evento -> precioEvento > 0))
                                                <small>@lang('global.precio')</small>
                                                <p class="font-weight-bold text-black mb-0">${{number_format($evento -> precioEvento)}} MXN @lang('global.por_persona')</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center d-flex align-items-center justify-content-center" style="min-height: 300px">
                            <h3>Sin eventos por el momento</h3>
                        </div>
                    @endif
                </div>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    {{ $eventos->links() }}
                </div>
            </div>



            <div class="fondo-verde position-relative overflow-hidden" style="z-index: 1">
                <div class="pt-2 position-relative {{Request::get('calendario') == 1 ? '' : 'd-none'}}" id="CalendarioContainer">

                    <div class="container-fluid w16">
                        <div class="row justify-content-end align-items-center">
                            <div class="col-12 col-md-6 mb-3 d-flex align-items-center justify-content-center">
                                <a href="{{route('front.eventos').'?calendario=1&dates='.(Request::get('dates') - 1).(Request::get('categoria') ? '&categoria='.Request::get('categoria') : '')}}" class="btn btn-sm btn-gold border-0 shadow-none" style="{{Request::get('dates') == 0 ? 'opacity: 0; pointer-events: none' : ''}}"><</a>
                                @if (App::getLocale() == 'en')
                                    <h5 class="text-center text-white font-weight-bold mx-4 mb-0">From {{$mes}} {{$fechas[0]}} to {{$fechas[1]}}</h5>
                                @else
                                    <h5 class="text-center text-white font-weight-bold mx-4 mb-0">Del {{$fechas[0]}} al {{$fechas[1]}} de {{App\Helpers::getMes($mes)}}</h5>
                                @endif
                                <a href="{{route('front.eventos').'?calendario=1&dates='.(Request::get('dates') + 1).(Request::get('categoria') ? '&categoria='.Request::get('categoria') : '')}}" class="btn btn-sm btn-gold border-0 shadow-none">></a>
                            </div>
                            <div class="col-12 col-md-3 text-center mb-3">
                                <button class="btn btn-gold toggleEventos">@lang('eventos.btn_ver_listado')</button>
                            </div>
                        </div>


                        {{-- Calendario --}}
                        <div class="bg-main mb-5">
                            <div class="calendar-week deco">
                                <div class="calendar-week-header d-flex">
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[0][0] : App\Helpers::getDia($calendario[0][0]) }}.<span>{{$calendario[0][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[1][0] : App\Helpers::getDia($calendario[1][0]) }}.<span>{{$calendario[1][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[2][0] : App\Helpers::getDia($calendario[2][0]) }}.<span>{{$calendario[2][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[3][0] : App\Helpers::getDia($calendario[3][0]) }}.<span>{{$calendario[3][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[4][0] : App\Helpers::getDia($calendario[4][0]) }}.<span>{{$calendario[4][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[5][0] : App\Helpers::getDia($calendario[5][0]) }}.<span>{{$calendario[5][1]}}</span></h5>
                                    </div>
                                    <div class="calendar-week-title">
                                        <h5>{{ (App::getLocale() == 'en') ? $calendario[6][0] : App\Helpers::getDia($calendario[6][0]) }}.<span>{{$calendario[6][1]}}</span></h5>
                                    </div>
                                </div>
                                <div class="calendar-week-body d-flex" style="min-height: 450px">
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[0][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[1][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[2][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[3][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[4][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[5][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="calendar-week-pilar">
                                        @foreach ($params as $ev)
                                            @if (date('d', strtotime($ev -> fechaEvento)) === $calendario[6][1])
                                                @include('pages.component.card-week')
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="bg-verde">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-3 col-xl-2 mb-4 text-center mb-lg-0 text-lg-left">
                                    <h5 class="text-white font-weight-bold">@lang('eventos.tlo_filtro_categorias')</h5>
                                </div>
                                <div class="col-12 col-lg-9 col-xl-10">
                                    <ul class="list-unstyled d-flex justify-content-between justify-content-sm-center justify-content-md-between">
                                        @foreach ($categorias as $item)
                                            <li class="text-center">
                                                <a href="{{route('front.eventos').'?calendario=1&categoria='.$item -> id}}">
                                                    <img class="mb-2" src="{{asset($item -> portada)}}" alt="{{(App::getLocale() == 'en') ? $item -> titulo_en : $item -> titulo}}">
                                                    {{-- <p>{{(App::getLocale() == 'en') ? $item -> titulo_en : $item -> titulo}}</p> --}}
                                                </a>
                                            </li>
                                        @endforeach
                                        {{-- <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-1.svg')}}" alt="Gastronomia"> <p>Gastronomia</p> </li>
                                        <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-2.svg')}}" alt="Naturaleza"> <p>Naturaleza</p> </li>
                                        <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-3.svg')}}" alt="Ciudad"> <p>Ciudad</p> </li>
                                        <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-4.svg')}}" alt="Wellness"> <p>Wellness</p> </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="eventos-detalle pt-5 pb-5">
            <div class="container">
                <h3 class="titulo text-center mb-5"><a href="https://www.instagram.com/amateexperiences/" target="_blank" rel="noopener noreferrer">@amateexperiences</a></h3>
                <script src="https://apps.elfsight.com/p/platform.js" defer></script>
                <div class="elfsight-app-3f18c3e5-75ec-459a-8482-c6da8ab28d7b"></div>
            </div>
        </div>
        <div class="eventos-comentarios pt-5 pb-5 d-none">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-md-10 col-lg-9">
                        <div class="swiper overflow-hidden" id="swipercomentarios">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center text-white">
                                    Ad culpa sunt voluptate exercitation dolor veniam occaecat cupidatat officia cupidatat id et. Pariatur incididunt proident dolor ea elit nulla cillum quis ipsum. Nostrud culpa veniam ullamco fugiat id. <br><br>
                                    Eu ex cillum magna incididunt magna exercitation culpa ad ex commodo. Exercitation nulla officia ut elit enim excepteur Lorem Lorem ullamco esse. Mollit ea sit ex culpa Lorem commodo amet est tempor commodo tempor fugiat et. Deserunt incididunt ullamco ea tempor est Lorem veniam aute aliquip reprehenderit. Exercitation laborum incididunt deserunt eu deserunt quis. Dolor officia sit elit laboris sunt dolore cillum nisi nostrud eu.</div>
                                <div class="swiper-slide text-center text-white">
                                    Enim non ullamco labore consectetur esse. Id dolor esse aute anim. Consequat laborum ut cupidatat sunt cupidatat duis. Commodo do officia aliquip enim officia pariatur. Nulla pariatur ullamco quis consequat ullamco enim. <br><br>
                                    Irure anim do pariatur elit sunt adipisicing do aliquip nisi anim ut veniam consequat. Duis cupidatat esse incididunt dolore. Amet laborum esse minim deserunt anim in officia sint pariatur quis irure consectetur. Reprehenderit eiusmod enim est sit ut proident tempor quis reprehenderit ea tempor est.</div>
                                <div class="swiper-slide text-center text-white">
                                    Irure in quis do qui quis ullamco fugiat. Fugiat aliquip nisi nisi in ullamco est. Aute deserunt nostrud adipisicing quis enim laborum proident laborum laborum. <br><br>
                                    Magna enim nulla non excepteur aliqua sunt anim amet. Esse laborum duis aute dolore nulla ut amet enim commodo ad quis in. Nostrud ad anim dolor veniam ad sit consectetur labore.</div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const EVENTO_VIEW_DETAIL = false;
        document.querySelectorAll('.toggleEventos').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('eventosContainer').classList.toggle('d-none');
                document.getElementById('CalendarioContainer').classList.toggle('d-none');
            });
        });
        
        
        document.querySelectorAll(".calendar-week-body .calendar-week-pilar").forEach(item => {
            if(!item.querySelector(".calendar-week-card")){
                item.innerHTML = "";
            }
        });
    
        
    </script>
    @if (Request::get('calendario') == 1)
        <script>
            $('html, body').animate({
                scrollTop: $("#listEventos").offset().top
            }, 100);
        </script>
    @endif
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush