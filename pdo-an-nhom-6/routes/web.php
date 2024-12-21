<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GiaoVienController;
use App\Http\Controllers\Thuan\HomeController;
use App\Http\Controllers\Thuan\CartController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Thuan\TestController;

// Trang chủ - không cần prefix
Route::get('/', [App\Http\Controllers\Thuan\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\Thuan\TestController::class, 'testCart'])->name('cart.test');
// Test route to add a sample item
Route::get('/test-add-item', function() {
    $cartController = new \App\Http\Controllers\Thuan\CartController();
    // Assuming ID 1 exists in your chuyennganh table
    $result = $cartController->addToCart(1);
    return redirect('/test');
});
// Admin routes group
Route::prefix('admin')->group(function () {
    // Guest middleware group
    Route::middleware('guest')->group(function () {
        Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [CustomAuthController::class, 'login']);
    });

    Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

    // Admin middleware group
    Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
        // Root route
        Route::get('/', function() {
            return redirect('/admin/index');
        })->name('root');

        // Dashboard
        Route::get('/index', fn() => view('index'))->name('index');

        // QLND routes
        Route::prefix('qlnd')->name('qlnd.')->group(function () {
            Route::get('/sinhvien/search', [LopController::class, 'searchSinhvien'])->name('searchSinhvien');
            Route::get('/giaovien/search', [GiaoVienController::class, 'search'])->name('searchGiaovien');
            Route::get('/giaovien/find-page', [GiaoVienController::class, 'findTeacherPage']);

            Route::get('/listSinhvien', [LopController::class, 'listAll'])->name('listSinhvien');
            Route::get('/listGiaovien', [GiaoVienController::class, 'listAll'])->name('listGiaovien');

            Route::get('/sinhvien/{id}', [SinhVienController::class, 'detail'])->name('sinhvien.detail');
            Route::get('/giaovien/{id}', [GiaoVienController::class, 'detail'])->name('giaovien.detail');
            Route::post('/giaovien/store', [GiaoVienController::class, 'store'])->name('giaovien.store');
            Route::get('/check-email-giaovien', [GiaoVienController::class, 'checkEmailExists'])->name('checkEmailGiaovien');
            Route::get('/giaovien/get-monhoc', [GiaoVienController::class, 'getMonHoc'])->name('getMonHoc');

            // Thêm route mới để lấy môn học theo khoa
            Route::get('/monhoc-by-khoa/{khoa_id}', [GiaoVienController::class, 'getMonHocByKhoa'])
                ->name('monhoc-by-khoa');
        });

        // Sinhvien routes
        Route::prefix('sinhvien')->name('sinhvien.')->group(function () {
            Route::get('/{id}/edit', [SinhVienController::class, 'edit'])->name('edit');
            Route::get('/{id}', [SinhVienController::class, 'show'])->name('show');
            Route::put('/{id}', [SinhVienController::class, 'update'])->name('update');
            Route::post('/', [SinhVienController::class, 'store'])->name('store');
        });

        // Giaovien routes
        Route::prefix('giaovien')->name('giaovien.')->group(function () {
            Route::get('/{id}/edit', [GiaoVienController::class, 'edit'])->name('edit');
            Route::get('/{id}', [GiaoVienController::class, 'show'])->name('show');
            Route::put('/{id}', [GiaoVienController::class, 'update'])->name('update');
        });

        // Asset routes
        Route::get('assets/{file}', function ($file) {
            $path = public_path('assets/' . $file);
            if (file_exists($path)) {
                return response()->file($path);
            }
            abort(404);
        })->where('file', '.*');

        Route::get('/check-email', [SinhVienController::class, 'checkEmail'])->name('check.email');

        // Catch-all routes
        Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
        Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
        Route::get('{any}', [RoutingController::class, 'root'])->name('any');
    });
});

// Thuan authentication routes
Route::prefix('thuan')->group(function () {
    Route::get('/chuyennganh/{id}', [HomeController::class, 'showChuyenNganh'])->name('chuyennganh.show');


    // Routes xử lý authentication
    Route::post('/login', [HomeController::class, 'login'])
        ->name('thuan.login')
        ->middleware('guest');

    Route::post('/register', [HomeController::class, 'register'])
        ->name('thuan.register')
        ->middleware('guest');

    Route::post('/logout', [HomeController::class, 'logout'])
        ->name('thuan.logout')
        ->middleware('auth');

    Route::post('/cart/add/{id_chuyennganh}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id_chuyennganh}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
});




