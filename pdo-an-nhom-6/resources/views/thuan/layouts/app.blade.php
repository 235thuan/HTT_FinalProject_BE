<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Management System')</title>
    <link href="{{ asset('css/homeLayout.css') }}" rel="stylesheet" type="text/css">
    @yield('styles')
</head>
<body>
    <div class="home0">
        @include('thuan.partials.header')
        <main>
            @yield('content')
        </main>
        @include('thuan.partials.footer')
    </div>

    <script>
        function showModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.getElementById('authDropdownMenu').style.display = 'none';
        }

        function hideModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function toggleAuthDropdown() {
            var dropdown = document.getElementById('authDropdownMenu');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        function toggleDropdown() {
            var dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        function login() {
            // Add your login logic here
            hideModal('loginModalContent');
        }

        function logout() {
            // Add your logout logic here
            document.getElementById('dropdownMenu').style.display = 'none';
        }

        window.onclick = function(event) {
            if (!event.target.matches('.home1332 img')) {
                var authDropdown = document.getElementById('authDropdownMenu');
                var userDropdown = document.getElementById('dropdownMenu');
                if (authDropdown && authDropdown.style.display === 'block') {
                    authDropdown.style.display = 'none';
                }
                if (userDropdown && userDropdown.style.display === 'block') {
                    userDropdown.style.display = 'none';
                }
            }
        }
    </script>
    @yield('scripts')
</body>
</html> 