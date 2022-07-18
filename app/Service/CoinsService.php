<?php

namespace App\Service;

use App\Http\Clients\Contracts\CoinHttpInterface;
use App\Service\Contracts\CoinsServicInterface;

class CoinsService implements CoinsServicInterface
{
    private $clientHttpGeck;

    public function __construct(CoinHttpInterface $coinHttp)
    {
            $this->clientHttpGeck = $coinHttp;
    }

    public function getPriceByCoin(string $coin)
    {
        try {
            $geckIdCoin = config("coins.{$coin}.geckId");

            if(is_null($geckIdCoin)){
                throw new \Exception('Coin Not Exist',404);
            }
            $responseApi = $this->clientHttpGeck->getPriceByCoin($geckIdCoin);
        }catch (\Exception $exception){
            return $exception;
        }

        return $responseApi;
    }
}
