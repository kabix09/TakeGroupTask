<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\MovieDto;
use App\Enums\GenreSourceEnum;
use App\Models\Genre;
use App\Models\Movie;

final class MovieRepository
{
    public function __construct(
        private readonly GenreRepository $genreRepo,
    ) {
    }

    public function store(MovieDto $dto): Movie
    {
        $localGenreIds = $this->genreRepo->getLocalIdsByTmdbIds(
            $dto->genreIds,
            GenreSourceEnum::MOVIE->value,
        );

        $movie = Movie::updateOrCreate(
            ['tmdb_id' => $dto->tmdbId],
            [
                'title' => $dto->title,
                'original_title' => $dto->originalTitle,
                'overview' => $dto->overview,
                'original_language' => $dto->originalLanguage,
                'release_date' => $dto->releaseDate,
                'poster_path' => $dto->posterPath,
                'backdrop_path' => $dto->backdropPath,
                'popularity' => $dto->popularity,
                'vote_average' => $dto->voteAverage,
                'vote_count' => $dto->voteCount,
                'adult' => $dto->adult,
                'video' => $dto->video,
            ]
        );

        $movie->genres()->sync($localGenreIds);
        return $movie;
    }
}
