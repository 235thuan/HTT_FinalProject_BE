<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Default Title')</title>

    <!-- Include core styles -->
    @include('layouts.includes.styles')
    
    <!-- Additional CSS -->
    @stack('css')
</head>

<body>
    @yield('content')

    <!-- Include core scripts -->
    @include('layouts.includes.scripts')

    <!-- Initialize dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manual dropdown initialization
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    var dropdownMenu = this.nextElementSibling;
                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    } else {
                        // Close all other dropdowns
                        document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                            menu.classList.remove('show');
                        });
                        dropdownMenu.classList.add('show');
                    }
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                        menu.classList.remove('show');
                    });
                }
            });
        });
    </script>

    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html> 