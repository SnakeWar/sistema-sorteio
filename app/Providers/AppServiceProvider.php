<?php

namespace App\Providers;

use App\Traits\Functions;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use Functions;
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
        Functions::class;
    }
}
