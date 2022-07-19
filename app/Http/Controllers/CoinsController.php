<?php

namespace App\Http\Controllers;

use App\Http\Clients\CoinHttpInterface;
use App\Http\Requests\PriceByCoinRequest;
use App\Services\Contracts\CoinsServicInterface;

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
            $responseService = $this->service->getPriceByCoin($request->coin);
            return  response($responseService->toArray(), 201);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), $exception->getCode());
        }
    }
}
