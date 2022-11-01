<?php

namespace Src\Factories;

use Exception;
use Src\ChildrensPrice;
use Src\Constans\MoviePriceCodes;
use Src\NewReleasePrice;
use Src\Price;
use Src\RegularPrice;

class PriceFactory
{
    /**
     * @throws Exception
     */
    public function create(int $priceCode): Price
    {
        return match ($priceCode) {
            MoviePriceCodes::REGULAR => new RegularPrice(),
            MoviePriceCodes::NEW_RELEASE => new NewReleasePrice(),
            MoviePriceCodes::CHILDRENS => new ChildrensPrice(),
            default => throw new Exception('Bad price code'),
        };
    }
}
