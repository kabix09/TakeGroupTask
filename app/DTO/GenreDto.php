<?php
declare(strict_types=1);

namespace App\DTO;

use App\Enums\GenreSourceEnum;

final class GenreDto
{
    public function __construct(
        private readonly int $tmdbId,
        private readonly string $name,
        private readonly GenreSourceEnum $type,
    ) {
    }

    public static function fromApiResponse(array $data, GenreSourceEnum $type): self
    {
        return new self(
            tmdbId: $data['id'],
            name: $data['name'],
            type: $type,
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

    public function getType(): GenreSourceEnum
    {
        return $this->type;
    }
}
