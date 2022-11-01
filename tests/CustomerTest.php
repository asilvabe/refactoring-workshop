<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Constans\MoviePriceCodes;
use Src\Customer;
use Src\Movie;
use Src\Rental;
use Tests\Factories\StatementFactory;

class CustomerTest extends TestCase
{
    /** @test */
    function rental(): void
    {
        $customerName = 'Customer name';

        $regularMovieName = 'regularMovieName';
        $regularMovie = new Movie($regularMovieName, MoviePriceCodes::REGULAR);

        $regularRental = new Rental($regularMovie, 10);

        $newReleaseMovieName = 'newReleaseMovieName';
        $newReleaseMovie = new Movie($newReleaseMovieName, MoviePriceCodes::NEW_RELEASE);

        $newReleaseRental = new Rental($newReleaseMovie, 10);

        $childrensMovieName = 'childrensMovieName';
        $childrensMovie = new Movie($childrensMovieName, MoviePriceCodes::CHILDRENS);

        $childrensRental = new Rental($childrensMovie, 10);

        $customer = new Customer($customerName);
        $customer->addRental($regularRental);
        $customer->addRental($newReleaseRental);
        $customer->addRental($childrensRental);

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($regularMovieName, 14)
            ->movie($newReleaseMovieName, 30)
            ->movie($childrensMovieName, 12)
            ->totalAmount(56)
            ->frequentRenterPoints(4)
            ->create();

        $this->assertEquals($expected, $customer->statement());
    }

    /** @test */
    function without_rentals(): void
    {
        $customerName = 'Customer name';

        $customer = new Customer($customerName);

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->totalAmount(0)
            ->frequentRenterPoints(0)
            ->create();

        $this->assertEquals($expected, $customer->statement());
    }

    /**
     * @test
     * @dataProvider statementProvider
     */
    function rental_for_different_movie_types_and_days(
        int $movieType,
        int $rentedDays,
        float $expectedTotalAmount,
        float $expectedFrequentRenterPoints
    ): void {
        $customerName = 'Customer name';
        $movieName = 'Movie name';

        $movie = new Movie($movieName, $movieType);

        $rental = new Rental($movie, $rentedDays);

        $customer = new Customer($customerName);

        $customer->addRental($rental);

        $expected = (new StatementFactory())
            ->customerName($customerName)
            ->movie($movieName, $expectedTotalAmount)
            ->totalAmount($expectedTotalAmount)
            ->frequentRenterPoints($expectedFrequentRenterPoints)
            ->create();

        $this->assertEquals($expected, $customer->statement());
    }

    public function statementProvider(): array
    {
        return [
            'Regular rental 1 day' => [MoviePriceCodes::REGULAR, 1, 2, 1],
            'Regular rental 2 days' => [MoviePriceCodes::REGULAR, 2, 2, 1],
            'Regular rental 3 days' => [MoviePriceCodes::REGULAR, 3, 3.5, 1],
            'New release rental 1 day' => [MoviePriceCodes::NEW_RELEASE, 1, 3, 1],
            'New release rental 2 days' => [MoviePriceCodes::NEW_RELEASE, 2, 6, 2],
            'New release rental 3 days' => [MoviePriceCodes::NEW_RELEASE, 3, 9, 2],
            'Childrens rental 1 day' => [MoviePriceCodes::CHILDRENS, 1, 1.5, 1],
            'Childrens rental 2 days' => [MoviePriceCodes::CHILDRENS, 2, 1.5, 1],
            'Childrens rental 3 days' => [MoviePriceCodes::CHILDRENS, 3, 1.5, 1],
            'Childrens rental 4 days' => [MoviePriceCodes::CHILDRENS, 4, 3, 1],
        ];
    }
}