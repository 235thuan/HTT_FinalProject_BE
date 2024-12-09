<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.partials/head-css')
    
    <!-- jQuery must be loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body data-menu-color="light" data-sidebar="default" @yield('body')>
    <div id="app-layout">
        @include('layouts.partials/topbar')
        @include('layouts.partials/sidebar')

        <div class="content-page">
            <div class="content">
                <div class="container-xxl">
                    @yield('content')
                </div>
            </div>

            @include("layouts.partials/footer")
        </div>
    </div>

    <!-- Scripts at the bottom -->
    @vite(['resources/js/app.js'])
    
    <!-- Use CDN versions instead of local files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    
    <!-- Initialize Feather icons -->
    <script>
        feather.replace();
    </script>

    <!-- Custom scripts -->
    @stack('scripts')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
</body>
</html>
