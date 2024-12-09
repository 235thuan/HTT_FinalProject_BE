<!DOCTYPE html>
<html>
<head>
    <!-- ... other head elements ... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- ... -->
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="nav-link" style="background: none; border: none;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</body>
</html> 