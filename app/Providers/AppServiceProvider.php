<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\kategoria;

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
        view()->composer('layout', function ($view) {

            $result = kategoria::select('kat_nev', 'kat_id')->get();

            $view->with([
                'result' => $result,
            ]);
        });
    }
}
