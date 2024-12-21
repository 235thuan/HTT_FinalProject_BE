<?php

namespace App\Http\Controllers\Thuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'trang_thai' => 'hoạt động'
            ])) {
                $request->session()->regenerate();

                return response()->json([
                    'success' => true,
                    'message' => 'Đăng nhập thành công',
                    'user' => Auth::user()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không chính xác'
            ], 401);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'ho_ten' => 'required|string|max:255',
                'email' => 'required|email|unique:nguoidung,email',
                'password' => 'required|min:6|confirmed',
                'user_type' => 'required|in:student,other'
            ]);

            DB::beginTransaction();

            // Create new user
            $userId = DB::table('nguoidung')->insertGetId([
                'ten_dang_nhap' => explode('@', $validated['email'])[0],
                'mat_khau' => Hash::make($validated['password']),
                'email' => $validated['email'],
                'trang_thai' => 'hoạt động'
            ]);

            // Assign role based on user_type
            $roleId = $validated['user_type'] === 'student' ? 3 : 7; // 3 for student, 7 for guest
            DB::table('phanquyen')->insert([
                'id_nguoidung' => $userId,
                'id_vaitro' => $roleId
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

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
