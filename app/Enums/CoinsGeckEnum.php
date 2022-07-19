<?php

namespace App\Enums;

class CoinsGeckEnum
{
    const bitcoin = "bitcoin";
    const dacxi = "dacxi";
    const ethereum = "ethereum";
    const atom = "bitcoin-atom";
    const luna = "terra-luna-2";

    public function getGeckCoin($coin)
    {
        switch ($coin) {
            case 'bitcoin':
                return self::bitcoin;
                break;
            case 'dacxi':
                return self::dacxi;
                break;
            case 'ethereum':
                return self::ethereum;
                break;
            case 'atom':
                return self::atom;
                break;
            case 'luna':
                return self::luna;
                break;
            default:
                return null;
        }
    }
}
