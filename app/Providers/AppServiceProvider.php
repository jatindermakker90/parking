<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Airport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $view->with(['airports' => Airport::where('airport_status','!=',config('constant.STATUS.DELETED'))->get()]);
        });
    }
}
