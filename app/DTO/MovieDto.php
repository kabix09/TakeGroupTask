<?php
declare(strict_types=1);

namespace App\DTO;

final class MovieDto
{
    public function __construct(
        public readonly int $tmdbId,
        public readonly string $title,
        public readonly ?string $originalTitle,
        public readonly ?string $overview,
        public readonly ?string $originalLanguage,
        public readonly ?string $releaseDate,
        public readonly ?string $posterPath,
        public readonly ?string $backdropPath,
        public readonly float $popularity,
        public readonly float $voteAverage,
        public readonly int $voteCount,
        public readonly bool $adult,
        public readonly bool $video,
        public readonly array $genreIds,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            tmdbId: $data['id'],
            title: $data['title'],
            originalTitle: $data['original_title'] ?? null,
            overview: $data['overview'] ?? null,
            originalLanguage: $data['original_language'] ?? null,
            releaseDate: $data['release_date'] ?? null,
            posterPath: $data['poster_path'] ?? null,
            backdropPath: $data['backdrop_path'] ?? null,
            popularity: (float) $data['popularity'],
            voteAverage: (float) $data['vote_average'],
            voteCount: (int) $data['vote_count'],
            adult: (bool) $data['adult'],
            video: (bool) $data['video'],
            genreIds: $data['genre_ids'] ?? [],
        );
    }

    public function getTmdbId(): int
    {
        return $this->tmdbId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->originalLanguage;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
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

    public function isVideo(): bool
    {
        return $this->video;
    }

    public function getGenreIds(): array
    {
        return $this->genreIds;
    }
}
