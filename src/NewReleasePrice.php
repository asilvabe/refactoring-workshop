<?php

namespace Src;

use Src\Constans\MoviePriceCodes;

class NewReleasePrice extends Price
{
    public function getPriceCode(): int
    {
        return MoviePriceCodes::NEW_RELEASE;
    }

    public function getCharge(int $daysRented): float
    {
        return $daysRented * 3;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $daysRented > 1 ? 2 : 1;
    }
}
