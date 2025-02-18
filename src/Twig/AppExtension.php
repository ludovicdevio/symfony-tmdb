<?php

namespace App\Twig;


use App\DTO\Movie;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('movie_poster', [$this, 'movie_poster']),
        ];
    }

    public function movie_poster(Movie $movie): string
    {
        return "https://image.tmdb.org/t/p/w500{$movie->poster_path}";
    }
}
