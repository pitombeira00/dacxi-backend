<?php

namespace Tests\Unit\Repository\Services;

use App\Adapters\HttpClient\CoinGeckoClientAdapter;
use App\DTO\Response\PriceResponseDTO;
use App\Http\Clients\CoinHttpInterface;
use App\Repository\Contracts\PriceRepositoryInterface;
use App\Repository\PriceRepository;
use App\Services\CoinsService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class CoinsServiceTest extends TestCase
{
    private CoinHttpInterface $coinHttpMock;
    private CoinsService $coinsService;
    private PriceRepositoryInterface $priceMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->coinHttpMock = $this->createMock(CoinGeckoClientAdapter::class);
        $this->priceMock = $this->createMock(PriceRepository::class);
        $this->coinsService = new CoinsService(
            $this->coinHttpMock,
            $this->priceMock
        );
    }

    /**
     * @test
     */
    public function shouldReturnPriceResponseDtoInGetCoinById()
    {
        $priceResponseMock = (new PriceResponseDTO())->createFromArray([
            'price' => 123.23,
            'coin' => 'bitcoin',
            'snapshot' => Carbon::now()
        ]);

        $this->coinHttpMock->method('getPriceByCoin')
            ->willReturn($priceResponseMock);

        $this->priceMock->method('save')
            ->willReturn($priceResponseMock);

        $this->assertInstanceOf(PriceResponseDTO::class, $this->coinsService->getPriceByCoin('bitcoin'));
        $this->assertEquals($priceResponseMock, $this->coinsService->getPriceByCoin('bitcoin'));
    }
}
