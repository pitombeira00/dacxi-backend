<?php

namespace App\Http\Controllers;

use App\Http\Clients\CoinHttpInterface;
use App\Http\Requests\PriceAndDatetimeRequest;
use App\Http\Requests\PriceByCoinRequest;
use App\Services\Contracts\CoinsServiceInterface;

class CoinsController extends Controller
{
    private $service;

    public function __construct(CoinsServiceInterface $coinsService)
    {
        $this->service = $coinsService;
    }

    public function getPriceByCoin(PriceByCoinRequest $request)
    {
        try {
            $responseService = $this->service->getPriceByCoin($request->coin);
            return  response($responseService->toArray(), 201);
        } catch (\Exception $exception) {
            return response()->json(["message" => $exception->getMessage()], $exception->getCode());
        }
    }

    public function getEstimatedPriceByCoin(PriceAndDatetimeRequest $request)
    {
        try {
            $responseService = $this->service->getEstimatePriceByCoin($request->coin, $request->datetime);
            return  response($responseService->toArray(), 200);
        } catch (\Exception $exception) {
            return response()->json(["message" => $exception->getMessage()], $exception->getCode());
        }
    }
}
