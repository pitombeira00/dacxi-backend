<?php

namespace App\Services;

use App\DTO\Response\PriceResponseDTO;
use App\Enums\CoinsGeckEnum;
use App\Http\Clients\CoinHttpInterface;
use App\Models\Price;
use App\Services\Contracts\CoinsServicInterface;

class CoinsService implements CoinsServicInterface
{
    private $clientHttpGeck;

    public function __construct(CoinHttpInterface $coinHttp)
    {
            $this->clientHttpGeck = $coinHttp;

    }

    public function getPriceByCoin(string $coin) : PriceResponseDTO
    {
        try {
            $responseApi = $this->clientHttpGeck->getPriceByCoin($coin);
            Price::create($responseApi->toArray());
        }catch (\Exception $exception){

            throw new \Exception($exception->getMessage(),$exception->getCode());
        }

        return $responseApi;
    }
}
