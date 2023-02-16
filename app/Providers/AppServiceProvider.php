<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('filter', function (
            $attribute, // attribute name
            $value,
            $params// field value
        ) {
            return !(in_array(strtolower($value),$params));
        },
        'incorrect value');

        Paginator::useBootstrap();
       // Paginator::defaultView('pagination.name'); for custom pagination
    }
}
