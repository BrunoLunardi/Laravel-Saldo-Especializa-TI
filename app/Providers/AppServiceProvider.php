<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//impor de Schema
use Illuminate\Support\Facades\Schema;

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
        //Define o tamanho das strings das migrations
        Schema::defaultStringLength(191);
    }
}
