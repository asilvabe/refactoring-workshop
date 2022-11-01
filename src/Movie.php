<?php

namespace Src;

use Exception;

class Movie
{
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;
    public const CHILDRENS = 2;

    private Price $price;

    public function __construct(
        private string $title,
        int $priceCode
    ) {
        $this->setPriceCode($priceCode);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPriceCode(): int
    {
        return $this->price->getPriceCode();
    }

    /**
     * @throws Exception
     */
    public function setPriceCode(int $priceCode): void
    {
        match ($priceCode) {
            Movie::REGULAR => $this->price = new RegularPrice(),
            Movie::NEW_RELEASE => $this->price = new NewReleasePrice(),
            Movie::CHILDRENS => $this->price = new ChildrensPrice(),
            default => throw new Exception('Bad price code'),
        };
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

    public function getFrequentRenterPoints(int $daysRented): int
    {
        if (($this->getPriceCode() == Movie::NEW_RELEASE) && $daysRented > 1) {
            return 2;
        }

        return 1;
    }
}
