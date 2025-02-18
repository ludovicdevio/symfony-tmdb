<?php

namespace App\Controller;

use App\Services\Tmdb\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    public function __construct(
        private readonly Client $client
    ){

    }

    #[Route('/', name: 'movie.index')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'movies' => $this->client->popular(),
        ]);
    }

    #[Route('/upcoming', name: 'movie.upcoming')]
    public function upcoming()
    {
        return $this->render('movie/upcoming.html.twig', [
            'movies' => $this->client->upcoming(),
        ]);
    }

    #[Route('/search', name: 'movie.search')]
    public function search(#[MapQueryParameter] string $query): Response
    {
        return $this->render('movie/search.html.twig', [
            'movies' => $this->client->search($query),
        ]);
    }

}
