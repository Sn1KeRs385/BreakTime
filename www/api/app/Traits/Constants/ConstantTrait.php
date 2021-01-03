<?php

namespace App\Traits\Constants;

use ReflectionClass;

trait ConstantTrait
{
    public static function getConstants(): array
    {
        $class = new ReflectionClass(__CLASS__);

        $consts = $class->getConstants();
        unset($consts['CREATED_AT']);
        unset($consts['UPDATED_AT']);

        return $consts;
    }
}

