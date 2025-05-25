<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\GenreDto;
use App\Models\Genre;

final class GenreRepository
{
    public function store(GenreDto $dto): Genre
    {
        return Genre::updateOrCreate(
            ['tmdb_id' => $dto->getTmdbId(), 'source' => $dto->getType()->value],
            ['name' => $dto->getName()]
        );
    }

    public function getLocalIdsByTmdbIds(array $tmdbIds, string $source): array
    {
        return Genre::query()
            ->whereIn('tmdb_id', $tmdbIds)
            ->where('source', $source)
            ->pluck('id')
            ->all();
    }
}
