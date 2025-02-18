<?php
namespace App\Services\Tmdb;

use App\DTO\Movie;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client
{
    private FilesystemAdapter $cache;

    public function __construct(
        private readonly HttpClientInterface $tmdbClient
    ) {
        $this->cache = new FilesystemAdapter();
    }

    public function popular(): array
    {
        return $this->cache->get('popular', function (ItemInterface $item) {
            $item->expiresAfter(3600);

            $response = $this->tmdbClient->request('GET', '/3/movie/popular', [
                'query' => [
                    'language' => 'fr-FR',
                ],
            ]);

            $data = $response->toArray();
            return array_map(
                fn($movie) => new Movie(
                    $movie['overview'],
                    $movie['poster_path'],
                    $movie['title']
                ),
                $data['results']
            );
        });
    }

    public function upcoming(): array
    {
        return $this->cache->get('upcoming', function (ItemInterface $item) {
            $item->expiresAfter(3600);

            $response = $this->tmdbClient->request('GET', '/3/movie/upcoming', [
                'query' => [
                    'language' => 'fr-FR',
                ],
            ]);

            $data = $response->toArray();
            return array_map(
                fn($movie) => new Movie(
                    $movie['overview'],
                    $movie['poster_path'],
                    $movie['title']
                ),
                $data['results']
            );
        });
    }

    public function search(string $query): array
    {
        $response = $this->tmdbClient->request('GET', '/3/search/movie', [
            'query' => [
                'query' => $query,
                'language' => 'fr-FR',
            ],
        ]);

        $data = $response->toArray();
        return array_map(
            fn($movie) => new Movie(
                $movie['overview'],
                $movie['poster_path'],
                $movie['title']
            ),
            $data['results']
        );
    }
}
