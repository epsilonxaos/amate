<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{env('APP_NAME')}}</title>

<link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/favicon/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('img/favicon/site.webmanifest')}}">
<link rel="mask-icon" href="{{asset('img/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<meta name="description" content="Amate experiences busca ser el puente entre Yucat&aacute;n, su cultura, sus ra&iacute;ces y los viajeros que buscan algo m&aacute;s que un viaje convencional, aquellos que buscan disfrutar la experiencia de convertirse en un local m&aacute;s." />
<meta name="author" content="Casa Amate" />
<meta property="og:type" content="es_MX" />
<meta property="og:locale" content="website" />
<meta property="og:site_name" content="Casa Amate" />
<meta property="og:title" content="Casa Amate" />
<meta property="og:url" content="{{route('front.eventos')}}" />
<meta property="og:description" content="Amate experiences busca ser el puente entre Yucat&aacute;n, su cultura, sus ra&iacute;ces y los viajeros que buscan algo m&aacute;s que un viaje convencional, aquellos que buscan disfrutar la experiencia de convertirse en un local m&aacute;s." />
<meta property="og:image" content="{{asset('images/fb.jpg')}}" />
