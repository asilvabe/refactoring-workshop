<?php

namespace Tests\Factories;

use Src\Customer;
use Src\Rental;

class CustomerFactory
{
    private string $name;
    private array $rentals = [];

    public function name(string $name): CustomerFactory
    {
        $this->name = $name;
        return $this;
    }

    public function rental(Rental $rental): CustomerFactory
    {
        $this->rentals[] = $rental;
        return $this;
    }

    public function create(): Customer
    {
        $customer = new Customer($this->name);

        foreach($this->rentals as $rental) {
            $customer->addRental($rental);
        }

        return $customer;
    }
}