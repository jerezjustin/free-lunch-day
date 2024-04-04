<?php

namespace App\Providers;

use App\Contracts\MarketServiceInterface;
use App\Services\AlegraMarketService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MarketServiceInterface::class, function () {
            return new AlegraMarketService(
                url: config('services.alegra.url')
            );
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
