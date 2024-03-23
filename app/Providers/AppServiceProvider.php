<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Genre;


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
        View::composer('components.nav-bar', function ($view) {
            $genres = Genre::limit(3)->get();
            $view->with('genres', $genres);
        });

        View::composer('components.footer', function ($view) {
            $view->with('genres', Genre::all());
        });
    }
}
