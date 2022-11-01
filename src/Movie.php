<?php

namespace Src;

use Exception;
use Src\Factories\PriceFactory;

class Movie
{
    private Price $price;

    /**
     * @throws Exception
     */
    public function __construct(
        private string $title,
        int $priceCode
    ) {
        $this->price = (new PriceFactory())->create($priceCode);
    }

    public function getTitle(): string
    {
        return $this->title;
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
