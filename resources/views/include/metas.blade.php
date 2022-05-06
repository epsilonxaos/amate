<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{env('APP_NAME')}}</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon')}}/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon')}}/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon')}}/favicon-16x16.png">
<link rel="manifest" href="{{asset('images/favicon')}}/site.webmanifest">
<link rel="mask-icon" href="{{asset('images/favicon')}}/safari-pinned-tab.svg" color="#1f2632">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<meta name="description" content="" />
<meta name="author" content="E-Stom" />
<meta property="og:type" content="en_US" />
<meta property="og:locale" content="website" />
<meta property="og:site_name" content="E-Stom" />
<meta property="og:title" content="E-Stom" />
<meta property="og:url" content="{{route('front.eventos')}}" />
<meta property="og:description" content="" />
<meta property="og:image" content="{{asset('images/fb.jpg')}}" />
