<?php

namespace Src;

class TextStatement extends Statement
{
    protected function getHeaderString(Customer $customer): string
    {
        return 'Rental Record for ' . $customer->getName() . PHP_EOL;
    }

    protected function eachRentalString(Rental $rental): string
    {
        return '    ' . $rental->getMovie()->getTitle() . " | " . $rental->getCharge() . PHP_EOL;
    }

    protected function getFooterString(Customer $customer): string
    {
        return
            'Amount owed is ' . $customer->getTotalCharge() . PHP_EOL .
            'You earned ' . $customer->getTotalFrequentRenterPoints() . ' frequent renter points';
    }
}
