<?php

namespace App\Constants\Dadata;

class DadataBounds
{
    public const COUNTRY = 'country';
    public const REGION = 'region';
    public const AREA = 'area';
    public const CITY = 'city';
    public const SETTLEMENT = 'settlement';
    public const STREET = 'street';
    public const HOUSE = 'house';

    public const AVAILABLE = [
        self::COUNTRY,
        self::REGION,
        self::AREA,
        self::CITY,
        self::SETTLEMENT,
        self::STREET,
        self::HOUSE,
    ];
}
