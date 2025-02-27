<?php

namespace App\Tests;


use App\DTO\Movie;
use App\Services\Tmdb\Client;
use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HelloWorldTest extends TestCase
{
    public function testMovieDto()
    {
        $movie = new Movie(
            'A test overview',
            '/test-poster.jpg',
            'Test Movie'
        );
        
        $this->assertEquals('A test overview', $movie->overview);
        $this->assertEquals('/test-poster.jpg', $movie->poster_path);
        $this->assertEquals('Test Movie', $movie->title);
    }
    
    public function testMovieWithNullPosterPath()
    {
        $movie = new Movie(
            'A test overview',
            null,
            'Test Movie'
        );
        
        $this->assertNull($movie->poster_path);
    }
    
    public function testMoviePosterFilter()
    {
        $extension = new AppExtension();
        $movie = new Movie('Overview', '/test-path.jpg', 'Test');
        
        $this->assertEquals(
            'https://image.tmdb.org/t/p/w500/test-path.jpg',
            $extension->movie_poster($movie)
        );
    }
    
    public function testMovieFilters()
    {
        $extension = new AppExtension();
        $filters = $extension->getFilters();
        
        $this->assertCount(1, $filters);
        $this->assertEquals('movie_poster', $filters[0]->getName());
    }
    
    public function testClientSearch()
    {
        $httpClientMock = $this->createMock(\Symfony\Contracts\HttpClient\HttpClientInterface::class);
        $responseMock = $this->createMock(\Symfony\Contracts\HttpClient\ResponseInterface::class);
        
        $httpClientMock->expects($this->once())
            ->method('request')
            ->with(
                'GET',
                '/3/search/movie',
                $this->callback(function($options) {
                    return isset($options['query']['query']) 
                        && $options['query']['query'] === 'test query'
                        && $options['query']['language'] === 'fr-FR';
                })
            )
            ->willReturn($responseMock);
            
        $responseMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'results' => [
                    [
                        'overview' => 'Test overview',
                        'poster_path' => '/test.jpg',
                        'title' => 'Test movie'
                    ]
                ]
            ]);
            
        $client = new Client($httpClientMock);
        $results = $client->search('test query');
        
        $this->assertCount(1, $results);
        $this->assertInstanceOf(Movie::class, $results[0]);
        $this->assertEquals('Test movie', $results[0]->title);
    }
}

class MovieTest extends TestCase
{
    
}