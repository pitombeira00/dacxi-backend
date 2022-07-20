<?php

namespace App\Services;

use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\CoinHttpInterface;
use App\Repository\Contracts\PriceRepositoryInterface;
use App\Services\Contracts\CoinsServicInterface;

class CoinsService implements CoinsServicInterface
{
    private $clientHttpGeck;
    private $priceRepository;

    public function __construct(CoinHttpInterface $coinHttp, PriceRepositoryInterface $priceRepository)
    {
        $this->clientHttpGeck = $coinHttp;
        $this->priceRepository = $priceRepository;
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
}
