<?php

namespace Tests\Unit\Repository\Services\DTO\Response;

use App\DTO\Response\PriceResponseDTO;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PriceResponseDTOTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnArrayInToArray()
    {
        $data = [
            'price' => 123.23,
            'coin' => 'bitcoin',
            'snapshot' => Carbon::now()
        ];

        $priceDto = new PriceResponseDTO();
        $priceDto->createFromArray($data);

        $this->assertIsArray($priceDto->toArray());
    }
}
