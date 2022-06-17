<?php

namespace Tests\Factories;

class StatementFactory
{
    private string $customerName;
    private array $movieNames = [];
    private array $amounts = [];
    private float $totalAmount = 0;
    private int $frequentRenterPoints = 0;

    public function customerName(string $customerName): StatementFactory
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function movie(string $movieName, float $amount): StatementFactory
    {
        $this->movieNames[] = $movieName;
        $this->amounts[] = $amount;

        return $this;
    }

    public function totalAmount(float $totalAmount): StatementFactory
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function frequentRenterPoints(int $frequentRenterPoints): StatementFactory
    {
        $this->frequentRenterPoints = $frequentRenterPoints;

        return $this;
    }

    public function create(): string
    {
        $result = 'Rental Record for ' . $this->customerName . PHP_EOL;

        for ($i = 0; $i < count($this->movieNames); $i++) {
            $result .= '    ' . $this->movieNames[$i] . " | " . $this->amounts[$i] . PHP_EOL;
        }

        $result .= 'Amount owed is ' . $this->totalAmount . PHP_EOL;
        $result .= 'You earned ' . $this->frequentRenterPoints . ' frequent renter points';

        return $result;
    }
}