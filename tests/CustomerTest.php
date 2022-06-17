<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Movie;
use Tests\Factories\CustomerFactory;
use Tests\Factories\MovieFactory;
use Tests\Factories\RentalFactory;
use Tests\Factories\StatementFactory;

class CustomerTest extends TestCase
{
    /** @test */
    function withoutRentals(): void
    {
        $customerName = 'Customer name';
        $customer = (new CustomerFactory())->name($customerName)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->totalAmount(0)
            ->frequentRenterPoints(0)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function regularRental1Day(): void
    {
        $movieName = 'Movie name';
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::REGULAR)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(1)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 2)
            ->totalAmount(2)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function regularRental2Day(): void
    {
        $movieName = 'Movie name';
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::REGULAR)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(2)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 2)
            ->totalAmount(2)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function regularRental3Day(): void
    {
        $movieName = 'Movie name';
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::REGULAR)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(3)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 3.5)
            ->totalAmount(3.5)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function newReleaseRental1Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::NEW_RELEASE)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(1)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 3)
            ->totalAmount(3)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function newReleaseRental2Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::NEW_RELEASE)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(2)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 3)
            ->totalAmount(3)
            ->frequentRenterPoints(2)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function newReleaseRental3Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::NEW_RELEASE)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(3)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 3)
            ->totalAmount(3)
            ->frequentRenterPoints(2)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function childrensRental1Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::CHILDRENS)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(1)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 1.5)
            ->totalAmount(1.5)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function childrensRental3Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::CHILDRENS)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(3)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 1.5)
            ->totalAmount(1.5)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function childrensRental4Day(): void
    {
        $movieName = "Movie name";
        $movie = (new MovieFactory())->title($movieName)->priceCode(Movie::CHILDRENS)->create();
        $rental = (new RentalFactory())->movie($movie)->daysRented(4)->create();
        $customerName = "Customer name";
        $customer = (new CustomerFactory())->name($customerName)->rental($rental)->create();
        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, 6)
            ->totalAmount(6)
            ->frequentRenterPoints(1)
            ->create();

        $this->assertEquals($expected, $statement);
    }

    /** @test */
    function rental(): void
    {
        $regularMovieName = "regularMovieName";
        $regularMovie = (new MovieFactory())->title($regularMovieName)->priceCode(Movie::REGULAR)->create();
        $regularRental = (new RentalFactory())->movie($regularMovie)->daysRented(10)->create();

        $newReleaseMovieName = "newReleaseMovieName";
        $newReleaseMovie = (new MovieFactory())->title($newReleaseMovieName)->priceCode(Movie::NEW_RELEASE)->create();
        $newReleaseRental = (new RentalFactory())->movie($newReleaseMovie)->daysRented(10)->create();

        $childrensMovieName = "childrensMovieName";
        $childrensMovie = (new MovieFactory())->title($childrensMovieName)->priceCode(Movie::CHILDRENS)->create();
        $childrensRental = (new RentalFactory())->movie($childrensMovie)->daysRented(10)->create();

        $customerName = "customerName";
        $customer = (new CustomerFactory())
            ->name($customerName)
            ->rental($regularRental)
            ->rental($newReleaseRental)
            ->rental($childrensRental)
            ->create();

        $statement = $customer->statement();

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($regularMovieName, 14)
            ->movie($newReleaseMovieName, 3)
            ->movie($childrensMovieName, 15)
            ->totalAmount(32)
            ->frequentRenterPoints(4)
            ->create();

        $this->assertEquals($expected, $statement);
    }
}