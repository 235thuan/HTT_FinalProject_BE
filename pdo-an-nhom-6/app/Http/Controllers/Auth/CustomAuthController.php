<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'ten_dang_nhap' => $credentials['username'],
            'password' => $credentials['password'],
            'trang_thai' => 'hoạt động'
        ])) {
            $request->session()->regenerate();

            if (Auth::user()->hasRole('Admin')) {
                return redirect('/admin/index');
            }

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        \Log::info('Logout route hit');

        // Clear all sessions first
        DB::table('sessions')->truncate();

        // Clear auth
        Auth::logout();

        // Clear session
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear remember me cookie
        $cookie = cookie()->forget('remember_web_');

        // Redirect with cookie clearing
        return redirect('/admin/login')->withCookie($cookie);
    }

    /**
     * Show lock screen
     */
    public function lockScreen()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        // Store complete user info in session before logging out
        $user = Auth::user();
        $userData = [
            'ten_nguoi_dung' => $user->ten_nguoi_dung,
            'ten_dang_nhap' => $user->ten_dang_nhap,
            'email' => $user->email ?? null,
            'avatar' => $user->avatar ?? null
        ];

        session(['locked_user' => $userData]);
        Auth::logout();

        return view('auth.lockscreen', ['user' => $userData]);
    }

    /**
     * Handle unlock attempt
     */
    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $lockedUser = session('locked_user');

        if (!$lockedUser) {
            return redirect('/admin/login');
        }

        // Attempt to unlock
        if (Auth::attempt([
            'ten_dang_nhap' => $lockedUser->ten_dang_nhap,
            'password' => $request->password,
            'trang_thai' => 'hoạt động'
        ])) {
            session()->forget('locked_user');

            // Redirect to admin index directly
            return redirect('/admin/index');
        }

        return back()->withErrors([
            'password' => 'Mật khẩu không chính xác'
        ]);
    }
}
