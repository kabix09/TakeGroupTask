<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\GenreRepository;
use App\Repositories\MovieRepository;
use App\Repositories\SeriesRepository;

class TmdbImportService
{
    public function __construct(
        private readonly TmdbRequestService $tmdbRequestService,
        private GenreRepository $genreRepo,
        private MovieRepository $movieRepo,
        private SeriesRepository $seriesRepo,
    ) {}

    public function importSeriesGenres(): int
    {
        $genres = $this->tmdbRequestService->getTvShowGenres();

        foreach ($genres as $genreDto) {
            $this->genreRepo->store($genreDto);
        }

        return count($genres);
    }

    public function importMovieGenres(): int
    {
        $genres = $this->tmdbRequestService->getMovieGenres();

        foreach ($genres as $genreDto) {
            $this->genreRepo->store($genreDto);
        }

        return count($genres);
    }

    public function importSeries(int $limit): int
    {
        $series = $this->tmdbRequestService->getSeries($limit);

        foreach ($series as $seriesDto) {
            $this->seriesRepo->store($seriesDto);
        }

        return count($series);
    }

    public function importMovies(int $limit): int
    {
        $movies = $this->tmdbRequestService->getMovies($limit);

        foreach ($movies as $movieDto) {
            $this->movieRepo->store($movieDto);
        }

        return count($movies);
    }
}
