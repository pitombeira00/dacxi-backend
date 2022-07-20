<?php

namespace App\Http\Clients;

use App\DTO\Response\PriceHistoryResponseDTO;
use App\DTO\Response\PriceResponseDTO;

interface CoinHttpInterface
{
    public function getPriceByCoin(string $coin): PriceResponseDTO;
    public function getHistoryPriceByCoin(string $coin): PriceHistoryResponseDTO;
    public function getHistoryPriceByCoinAndDate(string $coin, string $datetime): PriceResponseDTO;
}
