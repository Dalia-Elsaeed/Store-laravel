<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    $forbidden = ['admin', 'superuser', 'root', 'laravel'];

    Validator::extend('filter', function ($attribute, $value, $params) use ($forbidden) {
        return ! in_array(strtolower($value), array_map('strtolower', $forbidden));
    }, 'The :attribute contains an invalid value.');

    Paginator::useBootstrapFour();
    // Paginator::defaultView('pagination.custom');
}
}
