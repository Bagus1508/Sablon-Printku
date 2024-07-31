<?php

namespace App\Providers;

use App\Services\DataWilayahServices;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DataWilayahServices::class, function ($app) {
            return new DataWilayahServices();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Carbon::setLocale('id');
        Blade::component('layouts.app', 'app-layout');
        Blade::component('layouts.authentication', 'authentication-layout');

               //
        View::composer('*', function ($view) {
            $loggedInUser = auth()->user(); // Mendapatkan pengguna yang sedang login

            View::share('loggedInUser', $loggedInUser ?? '');
        });
    }
}
