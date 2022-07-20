<?php

namespace App\Providers;

use App\Adapters\HttpClient\CoinGeckoClientAdapter;
use App\Http\Clients\CoinHttpInterface;
use App\Repository\Contracts\PriceRepositoryInterface;
use App\Repository\PriceRepository;
use App\Services\CoinsService;
use App\Services\Contracts\CoinsServicInterface;
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
        $this->app->bind(PriceRepositoryInterface::class, PriceRepository::class);
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
