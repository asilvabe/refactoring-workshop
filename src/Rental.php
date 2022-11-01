<?php

namespace Src;

class Rental
{
    public function __construct(
        private Movie $movie,
        private int $daysRented
    ) {
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getDaysRented(): int
    {
        return $this->daysRented;
    }
    
    public function getCharge(): float
    {
        $result = 0;

        // determine amounts for each line
        switch ($this->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $result += 2;

                if ($this->getDaysRented() > 2) {
                    $result += ($this->getDaysRented() - 2) * 1.5;
                }

                break;

            case Movie::NEW_RELEASE:
                $result += $this->getDaysRented() * 3;

                break;

            case Movie::CHILDRENS:
                $result += 1.5;

                if ($this->getDaysRented() > 3) {
                    $result += ($this->getDaysRented() - 3) * 1.5;
                }

                break;
        }

        return $result;
    }

    public function getFrequentRenterPoints(): int
    {
        if (($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE) && $this->getDaysRented() > 1) {
            return 2;
        }

        return 1;
    }
}