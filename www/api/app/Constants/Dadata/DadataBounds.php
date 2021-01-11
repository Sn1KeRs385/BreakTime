<?php

namespace App\Constants\Dadata;

use App\Constants\LocationTypes;

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

    public const PARSE_ORDER_WITH_LOCATION_TYPES = [
        self::REGION => LocationTypes::REGION,
        self::AREA => LocationTypes::AREA,
        self::CITY => LocationTypes::CITY,
        self::SETTLEMENT => LocationTypes::SETTLEMENT,
        self::STREET => LocationTypes::STREET,
        self::HOUSE => LocationTypes::HOUSE,
    ];
}
