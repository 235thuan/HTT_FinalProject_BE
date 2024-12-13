<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
} 