<?php

namespace App\Services\Contracts;

use App\DTO\Response\PriceHistoryResponseDTO;
use App\DTO\Response\PriceResponseDTO;

interface EstimateCoinServiceInterface
{
    public function estimatePriceCoin(PriceHistoryResponseDTO $pricehistoryDTO, $datetime): PriceResponseDTO;
}
