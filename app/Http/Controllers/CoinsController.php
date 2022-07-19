<?php

namespace App\Http\Controllers;

use App\Http\Clients\CoinHttpInterface;
use App\Http\Requests\PriceByCoinRequest;
use App\Service\Contracts\CoinsServicInterface;

class CoinsController extends Controller
{
    private $service;

    public function __construct(CoinsServicInterface $coinsService)
    {
        $this->service = $coinsService;
    }

    public function getPriceByCoin(PriceByCoinRequest $request)
    {
        try {
            $responseController = $this->service->getPriceByCoin($request->coin);
            return  response($responseController, 201);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), $exception->getCode());
        }
    }
}
