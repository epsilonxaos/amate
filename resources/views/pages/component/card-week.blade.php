<div class="calendar-week-card {{App\Helpers::inTime($ev -> fechaEvento.' '.$ev -> horaEvento)}}">
    <a href="{{route('front.eventos.detalle', [$ev -> id, $ev -> url_amigable])}}" class="d-block">
        <h6 class="{{App\Helpers::colorCategoriaEvento($ev -> idCategoriaEvento)}}">{{(App::getLocale() == 'en') ? $ev -> categoriaEventoEn : $ev -> categoriaEvento}}</h6>
        <p class="instructor">{{(App::getLocale() == 'en') ? $ev -> titulo_en : $ev -> titulo}}</p>
        <p class="time">{{App\Helpers::dateTo12Hrs($ev -> horaEvento)}}</p>
    </a>
</div>