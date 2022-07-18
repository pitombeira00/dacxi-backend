<?php

namespace App\Service\Contracts;

interface CoinsServicInterface
{
    public function getPriceByCoin(string $coin);
}
