<?php

namespace Src;

class HtmlStatement extends Statement
{
    protected function getHeaderString(Customer $customer): string
    {
        return '<h1>Rental Record for ' . $customer->getName() . '</h1>' . PHP_EOL;
    }

    protected function eachRentalString(Rental $rental): string
    {
        return '    <li>' . $rental->getMovie()->getTitle() . " | " . $rental->getCharge() . '</li>' . PHP_EOL;
    }

    protected function getFooterString(Customer $customer): string
    {
        return
            '<p>Amount owed is ' . $customer->getTotalCharge() . '</p>' . PHP_EOL .
            '<p>You earned ' . $customer->getTotalFrequentRenterPoints() . ' frequent renter points</p>';
    }

    public function value(Customer $customer): string
    {
        $statement = $this->getHeaderString($customer);

        $statement .= '<ul>' . PHP_EOL;

        /** @var Rental $each */
        foreach($customer->getRentals() as $rental) {
            $statement .= $this->eachRentalString($rental);
        }

        $statement .= '</ul>' . PHP_EOL;

        $statement .= $this->getFooterString($customer);

        return $statement;
    }
}