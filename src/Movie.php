<?php

namespace Src;

class Movie
{
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;
    public const CHILDRENS = 2;

    public function __construct(
        private string $title,
        private int $priceCode
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $priceCode): void
    {
        $this->priceCode = $priceCode;
    }
}