<?php

namespace Src;

class ChildrensPrice extends Price
{
    public function getPriceCode(): int
    {
        return Movie::CHILDRENS;
    }
}
