<?php

namespace Src;

class Movie
{
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;
    public const CHILDRENS = 2;

    public function __construct(
        private string $title,
        private int $priceCode
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $priceCode): void
    {
        $this->priceCode = $priceCode;
    }

    public function getCharge(int $daysRented): float
    {
        $result = 0;

        // determine amounts for each line
        switch ($this->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;

                if ($daysRented > 2) {
                    $result += ($daysRented - 2) * 1.5;
                }

                break;

            case Movie::NEW_RELEASE:
                $result += $daysRented * 3;

                break;

            case Movie::CHILDRENS:
                $result += 1.5;

                if ($daysRented > 3) {
                    $result += ($daysRented - 3) * 1.5;
                }

                break;
        }

        return $result;
    }
}