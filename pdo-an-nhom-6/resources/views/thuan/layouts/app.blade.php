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

    <style>
        body {
            /* Background settings */
            background: url('../images/bg_all.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

            /* Center content */
            display: flex;
            justify-content: center;
            align-items: center;

            /* Full viewport height */
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .home0 {
            /* Làm cho div trong suốt */
            background: transparent;
            /* Đảm bảo div chiếm toàn bộ chiều cao */
            min-height: 100vh;
            /* Thêm một lớp overlay mờ nếu cần (tùy chọn) */
            background-color: rgba(255, 255, 255, 0.0); /* 0.0 là hoàn toàn trong suốt */
            position: relative;
            z-index: 1;
        }

        /* Nếu muốn thêm overlay mờ để text dễ đọc hơn */
        .home0::before {
            content: '';
            position: absolute;
            top: 0;
            left: 35px;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7); /* Điều chỉnh độ mờ tại đây */
            z-index: -1;
        }
    </style>
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
