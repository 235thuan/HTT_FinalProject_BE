<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home')</title>
    
    <!-- Vite Assets -->
    @viteReactRefresh
    @vite([
        'resources/css/thuan/homeLayout.css',
        'resources/js/thuan/homeLayout.js'
    ])
</head>
<body>
    <div class="home0">
        @include('thuan.layouts.header')
        @yield('content')
        @include('thuan.layouts.footer')
    </div>

    <!-- Back to top button -->
    <button id="backToTop" class="back-to-top">↑</button>
</body>
</html> 