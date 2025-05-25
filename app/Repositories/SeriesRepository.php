<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\SeriesDto;
use App\Enums\GenreSourceEnum;
use App\Models\Series;

class SeriesRepository
{
    public function __construct(
        private readonly GenreRepository $genreRepo,
    ) {
    }

    public function store(SeriesDto $dto): Series
    {
        $localGenreIds = $this->genreRepo->getLocalIdsByTmdbIds(
            $dto->genreIds,
            GenreSourceEnum::TV->value,
        );

        $series = Series::updateOrCreate(
            ['tmdb_id' => $dto->tmdbId],
            [
                'name' => $dto->name,
                'original_name' => $dto->originalName,
                'overview' => $dto->overview,
                'original_language' => $dto->originalLanguage,
                'first_air_date' => $dto->firstAirDate,
                'poster_path' => $dto->posterPath,
                'backdrop_path' => $dto->backdropPath,
                'popularity' => $dto->popularity,
                'vote_average' => $dto->voteAverage,
                'vote_count' => $dto->voteCount,
                'adult' => $dto->adult,
                'origin_countries' => $dto->originCountries,
            ]
        );

        $series->genres()->sync($localGenreIds);
        return $series;
    }
}
