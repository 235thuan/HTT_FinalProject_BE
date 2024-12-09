<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('AdminMiddleware: Checking request', [
            'path' => $request->path(),
            'user' => auth()->user()
        ]);

        if (!auth()->check() || !auth()->user()->hasRole('Admin')) {
            \Log::warning('AdminMiddleware: Access denied', [
                'authenticated' => auth()->check(),
                'isAdmin' => auth()->check() ? auth()->user()->hasRole('Admin') : false
            ]);
            
            return redirect('/login')->with('error', 'Admin access required');
        }

        return $next($request);
    }
} 