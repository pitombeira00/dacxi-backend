<?php

namespace App\Services\Contracts;

use App\DTO\Response\PriceHistoryResponseDTO;
use App\DTO\Response\PriceResponseDTO;

interface CoinsServiceInterface
{
    public function getPriceByCoin(string $coin): PriceResponseDTO;
    public function getEstimatePriceByCoin(string $coin, string $dateTime): PriceResponseDTO;
}
