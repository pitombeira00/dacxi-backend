<?php

namespace Tests\Unit\Services;

use App\Adapters\HttpClient\CoinGeckoClientAdapter;
use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\CoinHttpInterface;
use App\Services\CoinsService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class CoinsServiceTest extends TestCase
{
    private CoinHttpInterface $coinHttpMock;
    private CoinsService $coinsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->coinHttpMock = $this->createMock(CoinGeckoClientAdapter::class);
        $this->coinsService = new CoinsService(
            $this->coinHttpMock
        );
    }
    /**
     * @test
     */
    public function shouldReturnPriceResponseDtoInGetCoinById()
    {
        $this->coinHttpMock->method('getPriceByCoin')
            ->willReturn((new PriceResponseDTO())->createFromArray([
                'price' => 123.23,
                'coin' => 'bitcoin',
                'snapshot' => Carbon::now()
            ]));

        $this->assertInstanceOf(PriceResponseDTO::class, $this->coinsService->getPriceByCoin('bitcoin'));
    }
}
