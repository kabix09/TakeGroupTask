<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Series",
 *     type="object",
 *     title="Series",
 *     required={"id", "name", "tmdb_id"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tmdb_id", type="integer", example=2261),
 *
 *     @OA\Property(property="name", type="string", example="The Tonight Show Starring Johnny Carson"),
 *     @OA\Property(property="original_name", type="string", example="The Tonight Show Starring Johnny Carson"),
 *     @OA\Property(property="overview", type="string", example="Opis serialu..."),
 *     @OA\Property(property="original_language", type="string", example="en"),
 *
 *     @OA\Property(property="first_air_date", type="string", format="date", example="1962-10-01"),
 *     @OA\Property(property="poster_path", type="string", example="/uSvET5YUvHNDIeoCpErrbSmasFb.jpg"),
 *     @OA\Property(property="backdrop_path", type="string", example="/qFfWFwfaEHzDLWLuttWiYq7Poy2.jpg"),
 *
 *     @OA\Property(property="popularity", type="number", format="float", example=688.2477),
 *     @OA\Property(property="vote_average", type="number", format="float", example=7.463),
 *     @OA\Property(property="vote_count", type="integer", example=81),
 *
 *     @OA\Property(property="adult", type="boolean", example=false),
 *
 *     @OA\Property(
 *         property="origin_countries",
 *         type="array",
 *         @OA\Items(type="string", example="US")
 *     ),
 *
 *     @OA\Property(
 *         property="genres",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Genre")
 *     )
 * )
 */
final class Series extends Model
{
    protected $fillable = [
        'name', 'original_name', 'overview',
        'original_language', 'first_air_date', 'poster_path',
        'backdrop_path', 'popularity', 'vote_average',
        'vote_count', 'adult', 'origin_countries',
        'tmdb_id',
    ];

    protected $casts = [
        'origin_countries' => 'array',
        'adult' => 'boolean',
        'popularity' => 'float',
        'vote_average' => 'float',
        'vote_count' => 'integer',
        'first_air_date' => 'date',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->original_name;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getOriginalLanguage(): string
    {
        return $this->original_language;
    }

    public function getFirstAirDate(): ?\Illuminate\Support\Carbon
    {
        return $this->first_air_date;
    }

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function getVoteAverage(): float
    {
        return $this->vote_average;
    }

    public function getVoteCount(): int
    {
        return $this->vote_count;
    }

    public function isAdult(): bool
    {
        return $this->adult;
    }

    /**
     * @return string[]
     */
    public function getOriginCountries(): array
    {
        return $this->origin_countries ?? [];
    }

    public function getTmdbId(): int
    {
        return $this->tmdb_id;
    }
}
