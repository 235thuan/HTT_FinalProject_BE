<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Log;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The path to your application's "login" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const LOGIN = '/login';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        try {
            // Register the middleware
            $this->app['router']->aliasMiddleware('admin', AdminMiddleware::class);
            Log::info('AdminMiddleware registered successfully');
        } catch (\Exception $e) {
            Log::error('Error registering AdminMiddleware: ' . $e->getMessage());
        }

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
