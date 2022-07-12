<nav class="menu-movil d-lg-none">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-8">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/logo-header.svg')}}" alt="{{env('APP_NAME')}}" class="logo">
                </a>
            </div>
            <div class="col-4 text-right">
                <div class="menu menu-3 mt-2" id="btn-menu-toggle">
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-left">
        <ul class="menu-list">
            <li class="{{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">@lang('menu.experiencias')</a></li>
            <li class="text-center"><a href="{{route('front.eventos')}}?calendario=1">@lang('menu.calendario')</a></li>
            <li class="text-center"><a href="{{route('front.galeria')}}">@lang('menu.galeria')</a></li>
            <li class="text-center"><a href="{{route('front.arma')}}">@lang('menu.arma_exp')</a></li>
            <li class="text-center"><a href="{{route('front.nosotros')}}">@lang('menu.nosotros')</a></li>
            <li class="text-center"><a href="{{route('front.contacto')}}">@lang('menu.contacto')</a></li>
            {{-- <li class="text-center"><a href="">Idioma</a></li> --}}
            {{-- <li class="text-center">
                <a href="#" class="btn btn-gold" style="min-width: 197px">Reservar</a>
            </li> --}}
            <li class="text-center">
                <a class="btn btn-white" href="#mdSuscripcion" data-toggle="modal">@lang('menu.btn_reservacion')</a>
            </li>
            <li class="text-center pt-3">
                <a href="{{ route('change_lang', ['lang' => 'en']) }}" class="text-white mb-0" style="{{(App::getLocale() == 'en') ? 'color: #AC7A43 !important' : ''}}">EN</a> /
                <a href="{{ route('change_lang', ['lang' => 'es']) }}" class="text-white mb-0" style="{{(App::getLocale() == 'es') ? 'color: #AC7A43 !important' : ''}}">ES</a>
            </li>
            {{-- <li class="text-uppercase text-center"><a href="">Inicio</a></li>
            <li class="text-uppercase text-center"><a href="">Torneos</a></li>
            <li class="text-uppercase {{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Eventos</a></li> --}}
            {{-- <li class="text-uppercase"><a href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a></li> --}}
        </ul>
    </div>
</nav>

{{-- @php
    if(request()->is('/') || request()->is('concursos') || request()->is('eventos')){
        $tema = '';
        $tema_btn = 'btn-blanco-negro-invert';
        $logo = 'logo-blanco.png';
    }elseif (request()->is('nosotros/los_murmurantes/*')) {
        $tema = 'tema-negro';
        $tema_btn = 'btn-blanco-negro-invert';
        $logo = 'logo-blanco.png';
    }else {
        $tema = 'tema-blanco';
        $tema_btn = 'btn-blanco-negro';
        $logo = 'logo-negro.png';
    }
@endphp --}}

<nav class="menu-escritorio d-none d-lg-block">
    <div class="container-fluid w15">
        <div class="row align-items-center">
            <div class="col-md-2 pr-0">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/logo-header.svg')}}" alt="{{env('APP_NAME')}}" class="logo">
                </a>
            </div>
            <div class="col-md-8">
                <ul class="menu">
                    <li class="{{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">@lang('menu.experiencias')</a></li>
                    <li class="text-center"><a href="{{route('front.eventos')}}?calendario=1">@lang('menu.calendario')</a></li>
                    <li class="text-center"><a href="{{route('front.galeria')}}">@lang('menu.galeria')</a></li>
                    <li class="text-center"><a href="{{route('front.arma')}}">@lang('menu.arma_exp')</a></li>
                    <li class="text-center"><a href="{{route('front.nosotros')}}">@lang('menu.nosotros')</a></li>
                    <li class="text-center"><a href="{{route('front.contacto')}}">@lang('menu.contacto')</a></li>
                    <li class="text-center">
                        <a href="{{ route('change_lang', ['lang' => 'en']) }}" class="text-white mb-0" style="{{(App::getLocale() == 'en') ? 'color: #AC7A43 !important' : ''}}">EN</a> /
                        <a href="{{ route('change_lang', ['lang' => 'es']) }}" class="text-white mb-0" style="{{(App::getLocale() == 'es') ? 'color: #AC7A43 !important' : ''}}">ES</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 text-right">
                <a style="width: max-content" class="btn btn-white btn-sm" href="#mdSuscripcion" data-toggle="modal">@lang('menu.btn_reservacion')</a>
                {{-- <div style="max-width: min-content" class="ml-auto mr-0">
                    <a href="#" class="btn btn-gold w-100 btn-sm mb-2">Reservar</a>
                </div> --}}
            </div>
        </div>
    </div>
</nav>