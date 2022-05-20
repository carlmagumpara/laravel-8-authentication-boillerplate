<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('shared.meta')
    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/e27bdb27e2.js" crossorigin="anonymous"></script>
    <script data-ad-client="ca-pub-5978476567957143" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
  </head>
  <body class="dark">
    <div id="app">
      @include('layouts.app-nav', [
      'dashboard' => false
      ])
      <main id="content" class="py-4">
        <div class="app-main">
          @yield('content')
        </div>
      </main>
      @include('layouts.footer')
    </div>
    <div id="loading" class="d-none">
      <div id="loading-image">
        <h1><i class="fas fa-spinner"></i></h1>
      </div>
    </div>
    @yield('javascript')
  </body>
</html>
