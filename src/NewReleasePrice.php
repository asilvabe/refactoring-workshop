<?php

namespace Src;

class NewReleasePrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::NEW_RELEASE;
    }

    public function getCharge(int $daysRented): float
    {
        return $daysRented * 3;
    }
}
