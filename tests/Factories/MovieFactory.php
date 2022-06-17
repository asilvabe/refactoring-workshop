<?php

namespace Tests\Factories;

use Src\Movie;

class MovieFactory
{
    private string $title = 'Movie name';
    private int $priceCode;

    public function title(string $title): MovieFactory
    {
        $this->title = $title;
        return $this;
    }

    public function priceCode(int $priceCode): MovieFactory
    {
        $this->priceCode = $priceCode;
        return $this;
    }

    public function create(): Movie
    {
        return new Movie($this->title, $this->priceCode);
    }
}