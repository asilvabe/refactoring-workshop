<?php

namespace Src;

use Src\Constans\MoviePriceCodes;

class RegularPrice extends Price
{
    public function getPriceCode(): int
    {
        return MoviePriceCodes::REGULAR;
    }

    public function getCharge(int $daysRented): float
    {
        $result = 2;

        if ($daysRented > 2) {
            $result += ($daysRented - 2) * 1.5;
        }

        return $result;
    }
}
