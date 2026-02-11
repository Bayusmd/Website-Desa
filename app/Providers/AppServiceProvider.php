<?php

namespace App\Providers;
use App\Models\PermohonanSurat;
use App\Observers\PermohonanSuratObserver;

use Illuminate\Support\ServiceProvider;

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
        PermohonanSurat::observe(PermohonanSuratObserver::class);
    }
}
