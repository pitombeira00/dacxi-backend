<?php

namespace App\DTO\Response;

use Illuminate\Contracts\Support\Arrayable;

class PriceResponseDTO implements Arrayable
{
    private string $coin;
    private float $price;
    private string $snapshot;

    public function createToArray(array $data):self
    {
        $this->coin = $data['coin'];
        $this->price = $data['price'];
        $this->snapshot = $data['snapshot'];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'coin' => $this->coin,
            'price' => $this->price,
            'snapshot' => $this->snapshot,
        ];
    }

    /**
     * @return string
     */
    public function getCoin(): string
    {
        return $this->coin;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getSnapshot(): string
    {
        return $this->snapshot;
    }
}
