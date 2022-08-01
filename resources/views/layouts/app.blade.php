<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- plugin css -->
 <link href="https://www.nobleui.com/laravel/template/demo1-ds/assets/fonts/feather-font/css/iconfont.css" rel="stylesheet" />
  <link href="https://www.nobleui.com/laravel/template/demo1-ds/assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet" />
  <link href="https://www.nobleui.com/laravel/template/demo1-ds/assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" />
  <!-- end plugin css -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .auth-page .auth-side-wrapper {
    background-size: cover;
    height: 100%;
    width: 100%;
}
</style>
</head>
<body>
        <main class="py-4">
            @yield('content')
        </main>
</body>
</html>
