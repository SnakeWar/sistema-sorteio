<meta http-equiv="Content-Type" content="text/xml; charset=utf-8">
<meta http-equiv="content-language" content="pt-br">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="{{ $description ?? env('APP_DESCRIPTION', '') }}" />
<meta name="keywords" content="" />
<meta name="robots" content="index,follow,noodp">
<meta name="googlebot" content="index,follow">
<meta name="subject" content="{{ $title ?? env('APP_NAME', '') }}">
<meta name="abstract" content="{{ $title ?? env('APP_NAME', '') }}">
<meta name="topic" content="{{ $title ?? env('APP_NAME', '') }}">
<meta name="summary" content="{{ $title ?? env('APP_DESCRIPTION', '') }}">
<meta property="og:url" content="{{ $url ?? env('APP_URL') }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title ?? env('APP_NAME', '') }}">
<meta property="og:image" content="{{ $img ?? asset('assets/img/favicon.ico') }}">
<meta property="og:description" content="{{ $description ?? env('APP_DESCRIPTION', '') }}">
<meta property="og:site_name" content="{{ $title ?? env('APP_NAME', '') }}">
<meta property="og:locale" content="pt_BR">
<meta itemprop="name" content="{{ $title ?? env('APP_NAME', '') }}">
<meta itemprop="description" content="{{ $description ?? env('APP_DESCRIPTION', '') }}">
<meta itemprop="image" content="{{ $img ?? asset('assets/img/favicon.ico') }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="{{ env('APP_NAME', '') }}">
<meta name="twitter:url" content="{{ $url ?? env('APP_URL') }}">
<meta name="twitter:title" content="{{ $title ?? env('APP_NAME', '') }}">
<meta name="twitter:description" content="{{ $description ?? env('APP_DESCRIPTION', '') }}">
<meta name="twitter:image" content="{{ asset('assets/img/favicon.ico') }}">
<meta name="msapplication-TileColor" content="#3eb0ee">
<meta name="theme-color" content="#3eb0ee">

<title>{{ $title ?? env('APP_NAME', '') }}</title>
<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/owl-carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/owl-carousel/assets/owl.theme.default.min.css') }}">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
