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
        return $this->getMovie()->getCharge($this->getDaysRented());
    }

    public function getFrequentRenterPoints(): int
    {
        return $this->getMovie()->getFrequentRenterPoints($this->getDaysRented());
    }
}