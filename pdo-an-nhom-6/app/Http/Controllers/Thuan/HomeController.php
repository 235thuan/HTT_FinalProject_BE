<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Models\ChuyenNganh;
use App\Models\MonHoc;
use App\Services\Thuan\HomeService;
use Illuminate\Http\Request;
use App\Services\Thuan\ChuyenNganhService;
use App\Services\Thuan\MonHocService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    protected $chuyenNganhService;
    protected $monHocService;
    protected $homeService;

    public function __construct(
        ChuyenNganhService $chuyenNganhService,
        MonHocService $monHocService,
        HomeService $homeService
    ) {
        $this->chuyenNganhService = $chuyenNganhService;
        $this->monHocService = $monHocService;
        $this->homeService = $homeService;
    }
    public function index()
    {
        try {
            $chuyenNganhResult = $this->chuyenNganhService->getChuyenNganhForHomePage();
            $monHocResult = $this->monHocService->getMonHocForHomePage();

            if (!$chuyenNganhResult['success'] || !$monHocResult['success']) {
                return view('thuan.home')->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
            }

            return view('thuan.home', [
                'chuyenNganhs' => $chuyenNganhResult['chuyenNganhs'],
                'soNhom' => $chuyenNganhResult['soNhom'],
                'monHocs' => $monHocResult['monHocs']
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi không mong muốn trong HomeController: ' . $e->getMessage());
            return view('thuan.home')->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6'
            ], [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không hợp lệ',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự'
            ]);

            $result = $this->homeService->handleLogin(
                $credentials['email'],
                $credentials['password']
            );

            return response()->json($result, $result['success'] ? 200 : 401);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xử lý đăng ký
     */
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|email|unique:nguoidung,email',
                'password' => 'required|min:6|confirmed',
                'user_type' => 'required|in:student,other'
            ], [
                'ho_ten.required' => 'Vui lòng nhập họ tên',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã được sử dụng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.confirmed' => 'Mật khẩu xác nhận không khớp',
                'user_type.required' => 'Vui lòng chọn loại tài khoản'
            ]);

            $result = $this->homeService->handleRegister($validated);
            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Đăng xuất thành công'
        ]);
    }


    public function chuyenNganh()
    {
        try {
            $result = $this->chuyenNganhService->getChuyenNganhForHomePage();

            if (!$result['success']) {
                return back()->with('error', 'Có lỗi xảy ra khi tải dữ liệu');
            }

            return view('thuan.chuyennganh.chuyennganh', [
                'chuyenNganhs' => $result['chuyenNganhs'],
                'soNhom' => $result['soNhom']
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in HomeController@chuyenNganh: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }

    public function showChuyenNganh($id)
    {
        try {
            $result = $this->chuyenNganhService->getChuyenNganhDetail($id);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            // Remove the load() call since we're using DB::table()
            return view('thuan.chuyennganh.chuyennganh', [
                'chuyenNganh' => $result['chuyenNganh'],
                'monHocs' => $result['monHocs'],  // No load() needed
                'files' => $result['files']
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in HomeController@showChuyenNganh: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau.');
        }
    }
}
