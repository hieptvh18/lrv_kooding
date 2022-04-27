<head>
    {{-- token laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ico -->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/layout/kooding-app-icon.ico')}}"/>
    <!-- lib album -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@1.8.3/dist/css/lightgallery.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <!-- jq-ui -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- custom checkbox -->
    <link rel="stylesheet" href="{{asset('assets/css/lib/checkboxes.min.css')}}">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- css boostrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="{{asset('assets/css/style_layout.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/album.css')}}"> --}}

    @yield('plugin-head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title')</title>
</head>