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
      <div class="wrapper d-flex align-items-stretch">
        @if(Route::currentRouteName() !== 'quiz.questions.question')
        @include('layouts.dashboard-sidebar')
        @endif
        <!-- Page Content  -->
        <div id="content" class="dashboard py-4">
          @include('layouts.app-nav', [
          'dashboard' => true
          ])
          <div class="app-main">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    @yield('javascript')
    <div id="loading" class="d-none">
      <div id="loading-image">
        <h1><i class="fas fa-spinner"></i></h1>
      </div>
    </div>
  </body>
</html>
