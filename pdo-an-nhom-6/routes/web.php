<?php

use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Cuong\ProfileController;
use App\Http\Controllers\Hoa\ClientHocphiController;
use App\Http\Controllers\Thuan\CartController;
use App\Http\Controllers\Thuan\ClientAuthController;
use App\Http\Controllers\Thuan\ClientChuyennganhController;
use App\Http\Controllers\Thuan\ClientLophocController;
use App\Http\Controllers\Thuan\ClientMonhocController;
use App\Http\Controllers\Thuan\GiaoVienController;
use App\Http\Controllers\Thuan\HocPhiController;
use App\Http\Controllers\Thuan\HomeController;
use App\Http\Controllers\Thuan\LopController;
use App\Http\Controllers\Thuan\MienGiamController;
use App\Http\Controllers\Thuan\RoutingController;
use App\Http\Controllers\Thuan\ScheduleController;
use App\Http\Controllers\Thuan\SinhVienController;
use Illuminate\Support\Facades\Route;

// Trang chủ - không cần prefix
Route::get('/', [App\Http\Controllers\Thuan\HomeController::class, 'index'])->name('home');

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
        Route::get('/index', [ScheduleController::class, 'index'])->name('index');

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
            Route::get('/getLopList', [SinhVienController::class, 'getLopList'])->name('getLopList');
            Route::put('/{id}', [SinhVienController::class, 'update'])->name('update');
            Route::get('/{id}/edit', [SinhVienController::class, 'edit'])->name('edit');
            Route::get('/{id}', [SinhVienController::class, 'show'])->name('show');
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

        Route::prefix('hocphi')->group(function () {
            Route::get('/', [HocPhiController::class, 'index'])->name('hocphi.index');
            Route::get('/detail/{id}', [HocPhiController::class, 'detail'])->name('hocphi.detail');
            Route::post('/update-mien-giam', [HocPhiController::class, 'updateMienGiam'])->name('hocphi.updateMienGiam');
            Route::get('/{id}/edit', [HocPhiController::class, 'edit'])->name('hocphi.edit');
            Route::put('/{id}', [HocPhiController::class, 'update'])->name('hocphi.update');
            Route::get('/get-mien-giam/{monhocId}', [HocPhiController::class, 'getMienGiamByMonHoc'])->name('hocphi.getMienGiam');


            Route::get('sales', [HocPhiController::class, 'sales'])->name('hocphi.sales');
            Route::get('sales/{lop}', [HocPhiController::class, 'salesDetail'])->name('hocphi.sales.detail');


        });

        // Add this route
        Route::get('/profile', [App\Http\Controllers\Cuong\ProfileController::class, 'admin'])->name('cuong.admin.profile');

        // Catch-all routes
        Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
        Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
        Route::get('{any}', [RoutingController::class, 'root'])->name('any');
    });

    // Lock screen routes
    Route::get('/auth/lockscreen', [CustomAuthController::class, 'lockScreen'])->name('second');
    Route::post('/auth/unlock', [CustomAuthController::class, 'unlock'])->name('unlock');
});

// Thuan routes
Route::prefix('thuan')->group(function () {
    Route::get('/chuyennganh', [HomeController::class, 'chuyenNganh'])->name('chuyennganh.index');
    Route::get('/chuyennganh/{id}', [HomeController::class, 'showChuyenNganh'])->name('chuyennganh.show');

    Route::post('/cart/add/{id_chuyennganh}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id_chuyennganh}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');


    Route::prefix('miengiam')->group(function () {
        Route::get('/',  [MienGiamController::class, 'index'])->name('miengiam.index');
        Route::get('/create', [MienGiamController::class, 'create'])->name('miengiam.create');
        Route::post('/', [MienGiamController::class, 'store'])->name('miengiam.store');
        Route::get('/{id}/edit', [MienGiamController::class, 'edit'])->name('miengiam.edit');
        Route::put('/{id}', [MienGiamController::class, 'update'])->name('miengiam.update');
        Route::delete('/{id}', [MienGiamController::class, 'destroy'])->name('miengiam.destroy');
        Route::post('/check-overlap', [MienGiamController::class, 'checkOverlap'])->name('miengiam.checkOverlap');
    });

    Route::prefix('schedule')->controller(ScheduleController::class)->group(function () {
        Route::get('chuyennganh/{id}', 'chuyenNganh')->name('schedule.chuyennganh');
        Route::get('lop/{ten_lop}/{week?}', 'lopSchedule')->name('schedule.lop');

         // Quản lý thời khóa biểu
         Route::get('/create', 'create')->name('schedule.create');
         Route::post('/store', 'store')->name('schedule.store');
         Route::get('/edit/{id}', 'edit')->name('schedule.edit');
         Route::put('/update/{id}', 'update')->name('schedule.update');
         Route::delete('/delete/{id}', 'destroy')->name('schedule.destroy');

         // API kiểm tra xung đột
         Route::post('/check-conflicts', 'checkConflicts')->name('schedule.checkConflicts');
    });
});

// Client auth routes
Route::prefix('client')->group(function () {
    Route::post('/login', [ClientAuthController::class, 'login'])->name('client.login');
    Route::post('/register', [ClientAuthController::class, 'register'])->name('client.register');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

    Route::get('/chuyennganh',[ClientChuyenNganhController::class, 'index'])->name('client.chuyennganh');


    Route::get('/lophoc', [ClientLophocController::class, 'index'])->name('client.lophoc');
    Route::get('/monhoc', [ClientMonhocController::class, 'index'])->name('client.monhoc');
    Route::get('/monhoc/{id}', [ClientLophocController::class, 'detail'])->name('client.chitietmonhoc');

    // Add these new routes for AJAX calls
    Route::get('/lessons/{id_monhoc}', [ClientLophocController::class, 'getLessons'])->name('client.lessons');
    Route::get('/lesson/{id_noidung}', [ClientLophocController::class, 'getLesson'])->name('client.lesson.detail');


});

//
Route::prefix('cuong')->group(function () {
    Route::get('/tcn', [ProfileController::class, 'index'])->name('cuong.profile');
});
Route::prefix('hoa')->group( function () {
    Route::get('/hocphi', [ClientHocphiController::class, 'viewCart'])
        ->name('hoa.hocphi');
    Route::post('/hocphi/add/{id_chuyennganh}', [ClientHocphiController::class, 'addToCart'])
        ->name('hoa.hocphi.add');
    Route::post('/hocphi/remove/{id}', [ClientHocphiController::class, 'removeFromCart'])
        ->name('hoa.hocphi.remove')
        ->middleware('auth');

    Route::post('/hocphi/process-payment', [ClientHocphiController::class, 'processPayment'])
        ->name('hoa.hocphi.processPayment')
        ->middleware('auth');

    Route::post('/hocphi/update-session', [ClientHocphiController::class, 'updateSession'])
        ->name('hoa.hocphi.updateSession')
        ->middleware('auth');

    Route::post('/hocphi/save-selection', [ClientHocphiController::class, 'saveSelection'])
        ->name('hoa.hocphi.saveSelection')
        ->middleware('auth');

});



