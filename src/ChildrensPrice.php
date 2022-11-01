<?php

namespace Src;

class ChildrensPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::CHILDRENS;
    }

    public function getCharge(int $daysRented): float
    {
        $result = 1.5;

        if ($daysRented > 3) {
            $result += ($daysRented - 3) * 1.5;
        }

        return $result;
    }
}
