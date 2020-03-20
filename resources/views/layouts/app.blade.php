<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Rosy')</title> <!--Second argument is a default title-->

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   

    @yield('extra-css')
</head>
<body>
    @include('cookieConsent::index')
    <div id="app">
        @include('nav')
        @if(session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('message') }}
      </div>
      @endif
      <main class="py-4">
        @yield('content')
    </main>
    <footer >
        @include('footer')
    </footer>
    <!-- Scripts -->
   
    
     <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('extra-js')
</div>
</body>
</html>
