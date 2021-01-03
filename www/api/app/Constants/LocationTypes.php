<?php

namespace App\Constants;

use App\Traits\Constants\ConstantTrait;

class LocationTypes
{
    use ConstantTrait;

    const REGION = 1;
    const AREA = 2;
    const CITY = 3;
    const SETTLEMENT = 4;
    const STREET = 5;
    const HOUSE = 6;
}
