<?php

namespace App\Repository;

use App\DTO\Response\PriceResponseDTO;
use App\Models\Price;
use App\Repository\Contracts\PriceRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class PriceRepository implements PriceRepositoryInterface
{
    private Model $model;

    public function __construct(Price $price)
    {
        $this->model = $price;
    }

    public function save(PriceResponseDTO $data): PriceResponseDTO
    {
        $saved = $this->model::create($data->toArray());

        if (!$saved) {
            throw new Exception("Internal Error ", 500);
        }

        return $data;
    }
}
