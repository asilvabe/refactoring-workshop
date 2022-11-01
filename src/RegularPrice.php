<?php

namespace Src;

class RegularPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::REGULAR;
    }
}
