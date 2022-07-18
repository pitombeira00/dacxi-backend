<?php

namespace App\Http\Clients\Contracts;

use App\DTO\Response\PriceResponseDTO;

interface CoinHttpInterface
{
    public function getPriceByCoin(string $coin);
}
