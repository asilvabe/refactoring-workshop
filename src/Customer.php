<?php

namespace Src;

class Customer
{
    private array $rentals = [];

    public function __construct(
        private string $name
    ) {
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRentals(): array
    {
        return $this->rentals;
    }

    public function statement(): string
    {
        return (new TextStatement())->value($this);
    }

    public function htmlStatement(): string
    {
        return (new HtmlStatement())->value($this);
    }

    public function getTotalCharge(): float
    {
        $result = 0;

        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $result += $rental->getCharge();
        }

        return $result;
    }

    public function getTotalFrequentRenterPoints(): float
    {
        $result = 0;

        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $result += $rental->getFrequentRenterPoints();
        }

        return $result;
    }
}
