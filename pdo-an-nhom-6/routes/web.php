<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GiaoVienController;

// Add this at the top of your routes file
Route::get('/debug-routes', function() {
    $routes = collect(Route::getRoutes())->map(function ($route) {
        return [
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'methods' => $route->methods(),
            'action' => $route->getActionName(),
        ];
    });
    dd($routes->toArray());
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'login']);
});

Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// Admin routes - All admin functionality
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // Root route
    Route::get('/', function() {
        return redirect('/index');
    })->name('root');

    // Dashboard
    Route::get('/index', fn() => view('index'))->name('index');
    
    // QLND routes - MUST be before catch-all routes
    Route::prefix('qlnd')->name('qlnd.')->group(function () {
        // List routes
        Route::get('/listSinhvien', [LopController::class, 'listAll'])->name('listSinhvien');
        Route::get('/listGiaovien', [GiaoVienController::class, 'listAll'])->name('listGiaovien');
        
        // Detail routes
        Route::get('/sinhvien/{id}', [SinhVienController::class, 'detail'])->name('sinhvien.detail');
        Route::get('/giaovien/{id}', [GiaoVienController::class, 'detail'])->name('giaovien.detail');
    });

    // Sinhvien routes
    Route::prefix('sinhvien')->name('sinhvien.')->group(function () {
        Route::get('/{id}/edit', [SinhVienController::class, 'edit'])->name('edit');
        Route::get('/{id}', [SinhVienController::class, 'show'])->name('show');
        Route::put('/{id}', [SinhVienController::class, 'update'])->name('update');
    });

    // Giaovien routes
    Route::prefix('giaovien')->name('giaovien.')->group(function () {
        Route::get('/{id}/edit', [GiaoVienController::class, 'edit'])->name('edit');
        Route::get('/{id}', [GiaoVienController::class, 'show'])->name('show');
        Route::put('/{id}', [GiaoVienController::class, 'update'])->name('update');
    });

    // Asset routes - must be before catch-all routes
    Route::get('assets/{file}', function ($file) {
        $path = public_path('assets/' . $file);
        if (file_exists($path)) {
            return response()->file($path);
        }
        abort(404);
    })->where('file', '.*');

    // Catch-all routes MUST be last
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});


