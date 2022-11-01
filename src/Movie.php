<?php

namespace Src;

use Exception;
use Src\Factories\PriceFactory;

class Movie
{
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
        $this->price = (new PriceFactory())->create($priceCode);
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
