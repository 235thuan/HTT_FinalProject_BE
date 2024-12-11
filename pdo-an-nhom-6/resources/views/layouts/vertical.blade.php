<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.partials/head-css')
    
    <!-- Load Bootstrap CSS first -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Then other CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
    /* Ensure dropdowns work properly */
    .dropdown-menu {
        margin: 0;
        position: absolute;
        z-index: 1050;
        display: none;
    }
    .dropdown-menu.show {
        display: block;
    }
    .dropdown {
        position: relative;
    }
    .nav-link {
        cursor: pointer;
    }
    .dropdown-menu-end {
        --bs-position: end;
        right: 0;
        left: auto;
    }
    .notification-list .dropdown-menu {
        min-width: 300px;
    }
    .dropdown-toggle::after {
        display: none;
    }
    a{
        text-decoration: none;
    }
    span{
        color: #000;
    }
        
    </style>
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

    <!-- Scripts in correct order -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    @vite(['resources/js/app.js'])
    
    <script>
        // Initialize Feather icons
        feather.replace();
        
        // Manual dropdown handling
        $(document).ready(function() {
            // Initialize dropdowns manually
            $('.dropdown-toggle').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const menu = $(this).next('.dropdown-menu');
                $('.dropdown-menu').not(menu).removeClass('show');
                menu.toggleClass('show');
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });
        });

        // Initialize toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>

    <!-- Custom scripts -->
    @stack('scripts')
</body>
</html>
