<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


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
    public function boot()
    {
        View::composer('*', function ($view) {
            $unreadNotificationsCount = Auth::check()
                ? Auth::user()->notifications()->where('read', false)->count()
                : 0;

            $view->with('unreadNotificationsCount', $unreadNotificationsCount);
        });
    }
}
