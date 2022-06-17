<?php

namespace Tests\Factories;

use Src\Movie;
use Src\Rental;

class RentalFactory
{
    private Movie $movie;
    private int $daysRented;

    public function movie(Movie $movie): RentalFactory
    {
        $this->movie = $movie;
        return $this;
    }

    public function daysRented(int $daysRented): RentalFactory
    {
        $this->daysRented = $daysRented;
        return $this;
    }

    public function create(): Rental
    {
        return new Rental($this->movie, $this->daysRented);
    }
}