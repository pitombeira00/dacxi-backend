<?php

namespace App\Http\Clients;

use App\DTO\Response\PriceResponseDTO;

interface CoinHttpInterface
{
    public function getPriceByCoin(string $coin);
}
