<?php

namespace App\Providers;

use App\Adapters\HttpClient\CoinGeckoClientAdapter;
use App\Http\Clients\CoinHttpInterface;
use App\Repository\Contracts\PriceRepositoryInterface;
use App\Repository\PriceRepository;
use App\Services\CoinsService;
use App\Services\Contracts\CoinsServiceInterface;
use App\Services\Contracts\EstimateCoinServiceInterface;
use App\Services\EstimateCoinService;
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
        $this->app->bind(CoinsServiceInterface::class, CoinsService::class);
        $this->app->bind(PriceRepositoryInterface::class, PriceRepository::class);
        $this->app->bind(EstimateCoinServiceInterface::class, EstimateCoinService::class);
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
