<?php

namespace Src;

abstract class Statement
{
    abstract protected function getHeaderString(Customer $customer): string;

    abstract protected function eachRentalString(Rental $rental): string;

    abstract protected function getFooterString(Customer $customer): string;

    public function value(Customer $customer): string
    {
        // add header line
        $statement = $this->getHeaderString($customer);

        // add detail lines
        /** @var Rental $each */
        foreach($customer->getRentals() as $rental) {
            $statement .= $this->eachRentalString($rental);
        }

        // add footer lines
        $statement .= $this->getFooterString($customer);

        return $statement;
    }
}
