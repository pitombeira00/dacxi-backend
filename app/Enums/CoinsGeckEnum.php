<?php

namespace App\Enums;

class CoinsGeckEnum
{
    public const BITCOIN = "bitcoin";
    public const DACXI = "dacxi";
    public const ETHEREUM = "ethereum";
    public const ATOM = "bitcoin-atom";
    public const LUNA = "terra-luna-2";
    public const COINS = [
        self::BITCOIN => self::BITCOIN,
        self::DACXI => self::DACXI,
        self::ETHEREUM => self::ETHEREUM,
        self::ATOM => self::ATOM,
        self::LUNA => self::LUNA,
    ];
}
