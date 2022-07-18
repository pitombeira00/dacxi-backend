<?php

namespace App\Http\Clients;

use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\Contracts\CoinHttpInterface;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGeckoClientHttp implements CoinHttpInterface
{
    private $coinGeckoHttp;

    public function __construct(CoinGeckoClient $coinGeckoClient )
    {
        $this->coinGeckoHttp = $coinGeckoClient;
    }

    public function getPriceByCoin(string $coin)
    {
        return $this->coinGeckoHttp->coins()->getCoin($coin);
    }
}
