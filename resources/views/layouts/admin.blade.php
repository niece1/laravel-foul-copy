<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Rosy')</title> <!--Second argument is a default title-->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Tiny mce WYSIWYG editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({
     selector:".my_textarea",
     plugins: "link code",
    
 });
</script>
</head>
<body>
    <div id="app">
     @include('admin-nav') 
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
</div>
</body>
</html>