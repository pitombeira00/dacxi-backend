<?php

namespace App\Repository\Contracts;

use App\DTO\Response\PriceResponseDTO;

interface PriceRepositoryInterface
{
    public function save(PriceResponseDTO $data): PriceResponseDTO;
}
