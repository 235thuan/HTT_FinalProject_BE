<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate request
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // Direct database query matching your structure
        $user = DB::table('nguoidung')
            ->where(function($query) use ($credentials) {
                $query->where('ten_dang_nhap', $credentials['email'])
                      ->orWhere('email', $credentials['email']);
            })
            ->where('trang_thai', 'hoạt động')
            ->first();

        if ($user && Hash::check($credentials['password'], $user->mat_khau)) {
            // Manual authentication
            session([
                'user_id' => $user->id_nguoidung,
                'username' => $user->ten_dang_nhap,
                'email' => $user->email
            ]);
            
            // Log successful login
            DB::table('login_logs')->insert([
                'user_id' => $user->id_nguoidung,
                'login_time' => now(),
                'ip_address' => $request->ip()
            ]);

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (session()->has('user_id')) {
            // Log logout
            DB::table('login_logs')->insert([
                'user_id' => session('user_id'),
                'logout_time' => now(),
                'ip_address' => $request->ip()
            ]);
            
            session()->flush();
        }
        
        return redirect('/');
    }
} 