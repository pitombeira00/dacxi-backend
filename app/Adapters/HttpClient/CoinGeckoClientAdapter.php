<?php

namespace App\Adapters\HttpClient;

use App\DTO\Response\PriceResponseDTO;
use App\Enums\CoinsGeckEnum;
use App\Http\Clients\CoinHttpInterface;
use Carbon\Carbon;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGeckoClientAdapter implements CoinHttpInterface
{
    private $coinGeckoHttp;
    private $priceResponseDTO;
    private $coinsGeckEnum;

    public function __construct(CoinGeckoClient $coinGeckoClient, PriceResponseDTO $priceResponseDTO )
    {
        $this->coinGeckoHttp = new $coinGeckoClient;
        $this->priceResponseDTO = $priceResponseDTO;
        $this->coinsGeckEnum = new CoinsGeckEnum();
    }

    public function getPriceByCoin(string $coin): PriceResponseDTO
    {
        try {
            $coinIdGeck = $this->coinsGeckEnum->getGeckCoin($coin);

            if(is_null($coinIdGeck)){
                throw new \Exception('Coin Not Exist in Base',404);
            }
            $price = $this->coinGeckoHttp->coins()->getCoin($coinIdGeck);

            $this->priceResponseDTO->createFromArray([
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
