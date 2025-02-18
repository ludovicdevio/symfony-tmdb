<?php

namespace App\DTO;

final readonly class Movie
{
    public function __construct(
        public string $overview,
        public ?string $poster_path,
        public string $title

    ){

    }

}
