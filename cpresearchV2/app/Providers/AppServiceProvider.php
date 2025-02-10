<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        view()->composer(
            'layouts.layout', 
            function ($view) {
                //$view->with('dn', \App\Models\Program::where('degree_id', '=', 1)->get());
                $view->with('r', \Spatie\Permission\Models\Role::whereIn('id', [2, 6, 7, 8])->get());
            }
        );
    }
}
