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
            $topGenres = Genre::withCount(['contents' => function($query) {
                $query->where('type', 'movie');
            }])->orderBy('contents_count', 'desc')
                ->take(3)
                ->get();
    
            $view->with('topGenres', $topGenres);
        });

        View::composer('components.footer', function ($view) {
            $view->with('genres', Genre::all());
        });
    }
}
