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

    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;

        // add header line
        $result = 'Rental Record for ' . $this->getName() . PHP_EOL;

        // add detail lines
        foreach($this->rentals as $each) {
            $frequentRenterPoints += $each->getFrequentRenterPoints();

            // show figures for this rental
            $result .= '    ' . $each->getMovie()->getTitle() . " | " . $each->getCharge() . PHP_EOL;
            $totalAmount += $each->getCharge();
        }

        // add footer lines
        $result .= 'Amount owed is ' . $totalAmount . PHP_EOL;
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points';

        return $result;
    }
}
