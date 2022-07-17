<?php

namespace App\Http\Controllers;

use App\DTO\Response\PriceResponseDTO;
use App\Service\CoinsService;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    public function getPriceByCoin(Request $request)
    {
        //enviar para o servico de coins
        //factor de qual coin enviar
        //caso não consiga ele retorna para o banco local
        $servicePrice = new CoinsService();
        $servicePrice->getPriceByCoin($request->coin);
        return  'price';
    }
}
