<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
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

            $result = $this->authService->login(
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

            $result = $this->authService->register($validated);
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
} 