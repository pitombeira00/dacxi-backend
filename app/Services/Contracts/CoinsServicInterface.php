<?php

namespace App\Services\Contracts;

use App\DTO\Response\PriceResponseDTO;

interface CoinsServicInterface
{
    public function getPriceByCoin(string $coin): PriceResponseDTO;
}
