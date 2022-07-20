<?php

namespace App\DTO\Response;

use Illuminate\Contracts\Support\Arrayable;

class PriceHistoryResponseDTO implements Arrayable
{
    public string $coin;
    public float $currentPrice;
    public float $pricePercentage24hours;
    public float $pricePercentage7days;
    public float $pricePercentage14days;
    public float $pricePercentage30days;
    public float $pricePercentage60days;
    public float $pricePercentage200days;
    public float $pricePercentage1year;

    public function createFromArray(array $data):self
    {
        $this->coin = $data['coin'];
        $this->currentPrice = $data['current_price'];
        $this->pricePercentage24hours = $data['price_change_percentage_24h'];
        $this->pricePercentage7days = $data['price_change_percentage_7d'];
        $this->pricePercentage14days = $data['price_change_percentage_14d'];
        $this->pricePercentage30days = $data['price_change_percentage_30d'];
        $this->pricePercentage60days = $data['price_change_percentage_60d'];
        $this->pricePercentage200days = $data['price_change_percentage_200d'];
        $this->pricePercentage1year = $data['price_change_percentage_1y'];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'coin' => $this->coin,
            'current_price' => $this->currentPrice,
            'price_percentage_24_hours' => $this->pricePercentage24hours,
            'price_percentage_7d' => $this->pricePercentage7days,
            'price_percentage_14d' => $this->pricePercentage14days,
            'price_percentage_30d' => $this->pricePercentage30days,
            'price_percentage_60d' => $this->pricePercentage60days,
            'price_percentage_200d' => $this->pricePercentage200days,
            'price_percentage_1y' => $this->pricePercentage1year,
        ];
    }
}
