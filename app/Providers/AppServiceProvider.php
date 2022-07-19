<?php

namespace App\Providers;

use App\Adapters\HttpClient\CoinGeckoClientAdapter;
use App\Http\Clients\CoinHttpInterface;
use App\Service\CoinsService;
use App\Service\Contracts\CoinsServicInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CoinHttpInterface::class, CoinGeckoClientAdapter::class);
        $this->app->bind(CoinsServicInterface::class, CoinsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
