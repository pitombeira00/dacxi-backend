<?php

namespace App\Services;

use App\DTO\Response\PriceHistoryResponseDTO;
use App\DTO\Response\PriceResponseDTO;
use App\Services\Contracts\EstimateCoinServiceInterface;
use Carbon\Carbon;

class EstimateCoinService implements EstimateCoinServiceInterface
{
    protected const DATE_VALUES = [1, 7, 14, 30, 60, 200, 365];
    private $priceResponseDTO;

    public function __construct(PriceResponseDTO $priceResponseDTO)
    {
        $this->priceResponseDTO = $priceResponseDTO;
    }
//87988092829
    public function estimatePriceCoin(PriceHistoryResponseDTO $pricehistoryDTO, $datetime): PriceResponseDTO
    {
        $arrayPercentage = [
            $pricehistoryDTO->pricePercentage24hours,
            $pricehistoryDTO->pricePercentage7days,
            $pricehistoryDTO->pricePercentage14days,
            $pricehistoryDTO->pricePercentage30days,
            $pricehistoryDTO->pricePercentage60days,
            $pricehistoryDTO->pricePercentage200days,
            $pricehistoryDTO->pricePercentage1year,
        ];

        $values = $this->getValueTendecyFormula($arrayPercentage);
        $dateNow = new \DateTime();
        $difDays = $dateNow->diff(new \DateTime($datetime));

        $percentageDiff =  (- $difDays->d - $values['Value_A']) / $values['Value_B'];

        $estimatedValue = $pricehistoryDTO->currentPrice - ($pricehistoryDTO->currentPrice * $percentageDiff);

        return $this->priceResponseDTO->createFromArray([
            'coin' => $pricehistoryDTO->coin,
            'price' => $estimatedValue,
            'snapshot' => $datetime
        ]);
    }

    private function sumArrays($arrayDate, $arrayPercentage)
    {
        $total = 0;
        $itensForDate = count($arrayDate);

        for ($itens = 0; $itens < $itensForDate; $itens++) {

            $total += $arrayDate[$itens] + $arrayPercentage[$itens];

        }

        return $total;
    }

    private function squaredSumArrays(array $array)
    {
        $total = 0;
        $itensArray = count(self::DATE_VALUES);

        for ($item = 0; $item < $itensArray; $item++) {

            $total += ($array[$item] * $array[$item]);

        }
        return $total;
    }

    private function getValueTendecyFormula($arrayPercentage)
    {

        $sumPercentage = array_sum($arrayPercentage);
        $sumDate = array_sum(self::DATE_VALUES);
        $arrayPercentageInSquared = ($sumPercentage * $sumPercentage);

        $valueSquadredSumPercent =  $this->squaredSumArrays($arrayPercentage) * $sumDate;
        $valueSumPercentagePlusSumArays = $sumPercentage + $this->sumArrays(self::DATE_VALUES, $arrayPercentage);
        $valueCountMultiplicationSquadredPercent = $arrayPercentageInSquared * count($arrayPercentage);
        $vallueSquadredPercent = $arrayPercentageInSquared;
        $valueCountMultiplicationSum = count($arrayPercentage) * $this->sumArrays(self::DATE_VALUES, $arrayPercentage);
        $valueMultiplicationSumFromArrays = $sumPercentage * $sumDate;

        $regressFirstValue = ($valueSquadredSumPercent - $valueSumPercentagePlusSumArays) /
            ($valueCountMultiplicationSquadredPercent - $vallueSquadredPercent);


        $regressSecoundValue = ($valueCountMultiplicationSum - $valueMultiplicationSumFromArrays) /
            ($valueCountMultiplicationSquadredPercent - $vallueSquadredPercent);

        return [
            'Value_A' => $regressFirstValue,
            'Value_B' => $regressSecoundValue
        ];
    }
}
