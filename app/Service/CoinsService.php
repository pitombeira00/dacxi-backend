<?php

namespace App\Service;

use App\Http\Clients\CoinHttpInterface;
use App\Models\Price;
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
            $coinIdGeck = config("coins.{$coin}.geckId");
            $coinIdBase = config("coins.{$coin}.database");

            if(is_null($coinIdGeck)){
                throw new \Exception('Coin Not Exist',404);
            }
            $responseApi = $this->clientHttpGeck->getPriceByCoin($coinIdGeck);

            Price::create([
                'coin' => $coinIdBase,
                'price' => $responseApi->getPrice(),
                'snapshot' => $responseApi->getSnapshot()
            ]);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage(),$exception->getCode());
        }

        return $responseApi->toArray();
    }
}
