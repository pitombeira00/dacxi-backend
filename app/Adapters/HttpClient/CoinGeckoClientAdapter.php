<?php

namespace App\Adapters\HttpClient;

use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\CoinHttpInterface;
use Carbon\Carbon;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGeckoClientAdapter implements CoinHttpInterface
{
    private $coinGeckoHttp;
    private $priceResponseDTO;

    public function __construct(CoinGeckoClient $coinGeckoClient, PriceResponseDTO $priceResponseDTO )
    {
        $this->coinGeckoHttp = new $coinGeckoClient;
        $this->priceResponseDTO = $priceResponseDTO;
    }

    public function getPriceByCoin(string $coin)
    {
        try {
            $price = $this->coinGeckoHttp->coins()->getCoin($coin);

            $this->priceResponseDTO->createToArray([
                'coin' => $coin,
                'price' => $price["market_data"]["current_price"]["usd"],
                'snapshot' => Carbon::now(),
            ]);
        } catch (\Exception $exception){
           throw new \Exception($exception->getMessage(),$exception->getCode());
        }



        return $this->priceResponseDTO;
    }
}
