<?php
declare(strict_types=1);

namespace App\Services;

use App\Services\Request\HttpRequest;

final class TmdbRequestService
{
    private const MOVIE_POPULAR_ENDPOINT = 'movie/popular';
    private const TV_POPULAR_ENDPOINT = 'tv/popular';
    private const MOVIE_GENRES_ENDPOINT = 'genre/movie/list';
    private const TV_GENRES_ENDPOINT = 'genre/tv/list';

    public function __construct(
        private readonly HttpRequest $request,
    ) {
    }

    public function getMovies(int $limit = 10): array
    {
        $movies = [];
        $page = 1;

        while (count($movies) < $limit) {
            $response = $this->request->get(self::MOVIE_POPULAR_ENDPOINT, ['page' => $page]);

            if (!isset($response['results'])) {
                break;
            }

            foreach ($response['results'] as $movie) {
                $movies[] = $movie;
                if (count($movies) >= $limit) break;
            }

            $page++;
        }

        return $movies;
    }

    public function getSeries(int $limit = 10): array
    {
        $series = [];
        $page = 1;

        while (count($series) < $limit) {
            $response = $this->request->get(self::TV_POPULAR_ENDPOINT, ['page' => $page]);

            if (!isset($response['results'])) {
                break;
            }

            foreach ($response['results'] as $serie) {
                $series[] = $serie;
                if (count($series) >= $limit) break;
            }

            $page++;
        }

        return $series;
    }

    public function getMovieGenres(): array
    {
        return $this->request->get(self::MOVIE_GENRES_ENDPOINT);
    }

    public function getTvShowGenres(): array
    {
        return $this->request->get(self::TV_GENRES_ENDPOINT);
    }
}
