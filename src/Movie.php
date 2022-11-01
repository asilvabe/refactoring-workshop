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
        return $this->price->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $this->price->getFrequentRenterPoints($daysRented);
    }
}
