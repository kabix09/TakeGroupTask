<?php
declare(strict_types=1);

namespace App\DTO;

final class SeriesDto
{
    public function __construct(
        public readonly int $tmdbId,
        public readonly string $name,
        public readonly ?string $originalName,
        public readonly ?string $overview,
        public readonly ?string $originalLanguage,
        public readonly ?string $firstAirDate,
        public readonly ?string $posterPath,
        public readonly ?string $backdropPath,
        public readonly float $popularity,
        public readonly float $voteAverage,
        public readonly int $voteCount,
        public readonly bool $adult,
        public readonly array $genreIds,
        public readonly array $originCountries,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            tmdbId: $data['id'],
            name: $data['name'],
            originalName: $data['original_name'] ?? null,
            overview: $data['overview'] ?? null,
            originalLanguage: $data['original_language'] ?? null,
            firstAirDate: $data['first_air_date'] ?? null,
            posterPath: $data['poster_path'] ?? null,
            backdropPath: $data['backdrop_path'] ?? null,
            popularity: (float) $data['popularity'],
            voteAverage: (float) $data['vote_average'],
            voteCount: (int) $data['vote_count'],
            adult: (bool) $data['adult'],
            genreIds: $data['genre_ids'] ?? [],
            originCountries: $data['origin_country'] ?? [],
        );
    }

    public function getTmdbId(): int
    {
        return $this->tmdbId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->originalLanguage;
    }

    public function getFirstAirDate(): ?string
    {
        return $this->firstAirDate;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    public function getGenreIds(): array
    {
        return $this->genreIds;
    }

    public function getOriginCountries(): array
    {
        return $this->originCountries;
    }
}
