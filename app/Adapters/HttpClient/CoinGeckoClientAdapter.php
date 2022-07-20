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

    public function __construct(CoinGeckoClient $coinGeckoClient, PriceResponseDTO $priceResponseDTO)
    {
        $this->coinGeckoHttp = new $coinGeckoClient;
        $this->priceResponseDTO = $priceResponseDTO;
    }

    public function getPriceByCoin(string $coin): PriceResponseDTO
    {
        try {
            $coinIdGeck = CoinsGeckEnum::COINS[$coin];

            $price = $this->coinGeckoHttp->coins()->getCoin($coinIdGeck);

            $this->priceResponseDTO->createFromArray([
                'coin' => $coin,
                'price' => $price["market_data"]["current_price"]["usd"],
                'snapshot' => Carbon::now(),
            ]);

        } catch (\ErrorException) {
            throw new \Exception("Coin Not Exist in Base", 400);
        } catch (\Exception $exception) {
           throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $this->priceResponseDTO;
    }
}
