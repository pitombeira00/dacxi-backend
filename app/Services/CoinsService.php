<?php

namespace App\Services;

use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\CoinHttpInterface;
use App\Repository\Contracts\PriceRepositoryInterface;
use App\Services\Contracts\CoinsServiceInterface;
use App\Services\Contracts\EstimateCoinServiceInterface;
use Carbon\Carbon;

class CoinsService implements CoinsServiceInterface
{
    private $clientHttpGeck;
    private $priceRepository;
    private $estimateCoinService;

    public function __construct(
        CoinHttpInterface $coinHttp,
        PriceRepositoryInterface $priceRepository,
        EstimateCoinServiceInterface $estimateCoinService,
    )
    {
        $this->clientHttpGeck = $coinHttp;
        $this->priceRepository = $priceRepository;
        $this->estimateCoinService = $estimateCoinService;
    }

    public function getPriceByCoin(string $coin): PriceResponseDTO
    {
        try {
            $priceResponseDTO = $this->clientHttpGeck->getPriceByCoin($coin);
            $reponse = $this->priceRepository->save($priceResponseDTO);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return $reponse;
    }

    public function getEstimatePriceByCoin(string $coin, string $datetime): PriceResponseDTO
    {
        try {

            if ($datetime < Carbon::now()->format('Y-m-d H:i:s')) {
                return $this->clientHttpGeck->getHistoryPriceByCoinAndDate($coin, $datetime);
            }

            $response = $this->clientHttpGeck->getHistoryPriceByCoin($coin);
            return $this->estimateCoinService->estimatePriceCoin($response, $datetime);
        } catch (\Exception $exception) {
            dd($exception);
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
