<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('contract')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/contract.php'));
            Route::prefix('payment')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/payment.php'));
            Route::prefix('timesheet')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/timesheet.php'));
            Route::prefix('rentEvent')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/rentEvent.php'));
            Route::prefix('subject')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/subject.php'));
            Route::prefix('additional')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/additional.php'));
            Route::prefix('printDocument')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/printDocument.php'));
            Route::prefix('gibddfine')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/gibddfine.php'));
            
            Route::prefix('document')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/document.php'));
            
            Route::prefix('file')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/file.php'));
              Route::prefix('report')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/report.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
