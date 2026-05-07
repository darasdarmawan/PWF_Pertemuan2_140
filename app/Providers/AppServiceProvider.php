<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use App\Models\Product;
use App\Policies\ProductPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

   public function boot(): void
    {
        // Gate: hanya admin yang bisa manage product
        Gate::define('manage-product', function ($user) {
            return $user->role === 'admin';
        });

        // Gate: hanya admin yang bisa manage category
        Gate::define('manage-category', function ($user) {
            return $user->role === 'admin';
        });

        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        Gate::define('viewApiDocs', function () {
            return true;
        });
    }
}