<?php

namespace App\Providers;

use App\Services\AHPCalculationService;
use App\Services\SMARTCalculationService;
use Illuminate\Support\ServiceProvider;

class SMARTServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AHPCalculationService::class, function ($app) {
            return new AHPCalculationService();
        });

        $this->app->singleton(SMARTCalculationService::class, function ($app) {
            return new SMARTCalculationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}