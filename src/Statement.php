<?php

namespace Src;

abstract class Statement
{
    abstract protected function getHeaderString(Customer $customer): string;

    abstract protected function eachRentalString(Rental $rental): string;

    abstract protected function getFooterString(Customer $customer): string;

    public function value(Customer $customer): string
    {
        $statement = $this->getHeaderString($customer);

        /** @var Rental $each */
        foreach($customer->getRentals() as $rental) {
            $statement .= $this->eachRentalString($rental);
        }

        $statement .= $this->getFooterString($customer);

        return $statement;
    }
}
