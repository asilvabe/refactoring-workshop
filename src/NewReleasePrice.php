<?php

namespace Src;

class NewReleasePrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::NEW_RELEASE;
    }
}
