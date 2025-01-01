<?php

namespace Brightweb\Ecommerce\Providers;

use Brightweb\Ecommerce\Http\Middleware\AdminMiddleware;
use Brightweb\Ecommerce\Http\Middleware\UsersMiddleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class BrightserviceProvider extends ServiceProvider
{
    public function register(): void
    {
        Paginator::useBootstrapFive();
    }

    public function boot(): void
    {
        // middleware registration
        $this->app['router']->aliasMiddleware('admin', AdminMiddleware::class);
        $this->app['router']->aliasMiddleware('user', UsersMiddleware::class);



        // Loading routes and views when the package is booted.
        $this->loadRoutesFrom(__DIR__.'/../routes/adminroute.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/frontendroute.php');
        // $this->loadRoutesFrom(__DIR__.'/../routes/filesroutes.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/checkoutroutes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'brightweb');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $publicPath = public_path('vendor/brightweb');
        $packagePublicPath = __DIR__.'/../public';

        // Attempt to create a symlink
        if (!is_link($publicPath)) {
            if (!@symlink($packagePublicPath, $publicPath)) {
                // Fallback: Copy files if symlink creation fails
                if (!File::exists($publicPath)) {
                    File::copyDirectory($packagePublicPath, $publicPath);
                }
            }
        }

       
    }

  
}
