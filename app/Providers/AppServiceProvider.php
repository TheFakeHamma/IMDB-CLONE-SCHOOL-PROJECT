<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Genre;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')){
            URL::forceScheme('https');
        }

        View::composer('components.nav-bar', function ($view) {
            $genres = Genre::limit(3)->get();
            $view->with('genres', $genres);
        });

        View::composer('components.footer', function ($view) {
            $view->with('genres', Genre::all());
        });
    }
}
