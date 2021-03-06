<?php

namespace Src;

class Customer
{
    private string $name;
    private array $rentals = [];

    public function __construct(string $name)
    {
        $this->name = $name;
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
            $thisAmount = 0;

            // determine amounts for each line
            switch ($each->getMovie()->getPriceCode()) {
                case Movie::REGULAR:
                    $thisAmount += 2;
                    if ($each->getDaysRented() > 2) {
                        $thisAmount += ($each->getDaysRented() - 2) * 1.5;
                    }
                    break;

                case Movie::NEW_RELEASE:
                    $thisAmount += 3;
                    break;

                case Movie::CHILDRENS:
                    $thisAmount += 1.5;
                    if ($each->getDaysRented() > 3) {
                        $thisAmount += ($each->getDaysRented() - 1) * 1.5;
                    }
                    break;
            }

            // add frequent renter points
            $frequentRenterPoints++;

            // add bonus for a two day new release rental
            if (
                ($each->getMovie()->getPriceCode() == Movie::NEW_RELEASE)
                && $each->getDaysRented() > 1
            ) {
                $frequentRenterPoints++;
            }

            // show figures for this rental
            $result .= '    ' . $each->getMovie()->getTitle() . " | " . $thisAmount . PHP_EOL;
            $totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= 'Amount owed is ' . $totalAmount . PHP_EOL;
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points';

        return $result;
    }
}
