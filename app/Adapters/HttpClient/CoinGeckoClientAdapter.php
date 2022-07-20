<?php

namespace App\Adapters\HttpClient;

use App\DTO\Response\PriceHistoryResponseDTO;
use App\DTO\Response\PriceResponseDTO;
use App\Enums\CoinsGeckEnum;
use App\Http\Clients\CoinHttpInterface;
use Carbon\Carbon;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CoinGeckoClientAdapter implements CoinHttpInterface
{
    private $coinGeckoHttp;
    private $priceResponseDTO;
    private $priceHistoryResponseDTO;

    public function __construct(
        CoinGeckoClient $coinGeckoClient,
        PriceResponseDTO $priceResponseDTO,
        PriceHistoryResponseDTO $priceHistoryResponseDTO
    )
    {
        $this->coinGeckoHttp = new $coinGeckoClient;
        $this->priceResponseDTO = $priceResponseDTO;
        $this->priceHistoryResponseDTO = $priceHistoryResponseDTO;
    }

    public function getPriceByCoin(string $coin): PriceResponseDTO
    {
        try {
            $coinIdGeck = CoinsGeckEnum::COINS[$coin];

            $price = $this->coinGeckoHttp->coins()->getCoin($coinIdGeck);

            $this->priceResponseDTO->createFromArray([
                'coin' => $coin,
                'price' => $price["market_data"]["current_price"]["usd"],
                'snapshot' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

        } catch (\ErrorException) {
            throw new \Exception("Coin Not Exist in Base", 400);
        } catch (\Exception $exception) {
           throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $this->priceResponseDTO;
    }

    public function getHistoryPriceByCoin(string $coin): PriceHistoryResponseDTO
    {
        try {
            $coinIdGeck = CoinsGeckEnum::COINS[$coin];

            $price = $this->coinGeckoHttp->coins()->getCoin($coinIdGeck);

            $this->priceHistoryResponseDTO->createFromArray([
                'coin' => $coin,
                'current_price' => $price['market_data']['current_price']['usd'],
                'price_change_percentage_24h' => $price["market_data"]["price_change_percentage_24h"],
                'price_change_percentage_7d' => $price["market_data"]["price_change_percentage_7d"],
                'price_change_percentage_14d' => $price["market_data"]["price_change_percentage_14d"],
                'price_change_percentage_30d' => $price["market_data"]["price_change_percentage_30d"],
                'price_change_percentage_60d' => $price["market_data"]["price_change_percentage_60d"],
                'price_change_percentage_200d' => $price["market_data"]["price_change_percentage_200d"],
                'price_change_percentage_1y' => $price["market_data"]["price_change_percentage_1y"],
            ]);

        } catch (\ErrorException $exception) {
            throw new \Exception("Coin Not Exist in Base", 400);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $this->priceHistoryResponseDTO;
    }

    public function getHistoryPriceByCoinAndDate(string $coin, string $datetime): PriceResponseDTO
    {
        try {
            $coinIdGeck = CoinsGeckEnum::COINS[$coin];
            $date = Carbon::createFromDate($datetime)->format('d-m-Y');

            $price = $this->coinGeckoHttp->coins()->getHistory($coinIdGeck, $date);

            $this->priceResponseDTO->createFromArray([
                'coin' => $coin,
                'price' => $price["market_data"]["current_price"]["usd"],
                'snapshot' => $datetime,
            ]);
        } catch (\ErrorException $exception) {
            throw new \Exception("Coin Not Exist in Base", 400);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $this->priceResponseDTO;
    }
}
