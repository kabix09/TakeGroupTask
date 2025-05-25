<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Movie",
 *     type="object",
 *     title="Movie",
 *     required={"id", "title", "tmdb_id"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tmdb_id", type="integer", example=574475),

 *     @OA\Property(property="title", type="string", example="Final Destination Bloodlines"),
 *     @OA\Property(property="original_title", type="string", example="Final Destination Bloodlines"),
 *     @OA\Property(property="overview", type="string", example="Plagued by a violent recurring nightmare, college student Stefanie..."),
 *     @OA\Property(property="original_language", type="string", example="en"),

 *     @OA\Property(property="release_date", type="string", format="date", example="2025-05-09"),
 *     @OA\Property(property="poster_path", type="string", example="/6WxhEvFsauuACfv8HyoVX6mZKFj.jpg"),
 *     @OA\Property(property="backdrop_path", type="string", example="/j0NUh5irX7q2jIRtbLo8TZyRn6y.jpg"),

 *     @OA\Property(property="popularity", type="number", format="float", example=551.0284),
 *     @OA\Property(property="vote_average", type="number", format="float", example=7.117),
 *     @OA\Property(property="vote_count", type="integer", example=356),

 *     @OA\Property(property="adult", type="boolean", example=false),
 *     @OA\Property(property="video", type="boolean", example=false),

 *     @OA\Property(
 *         property="genres",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Genre")
 *     )
 * )
 */
final class Movie extends Model
{
    protected $fillable = [
        'title', 'original_title', 'overview',
        'original_language', 'release_date', 'poster_path',
        'backdrop_path', 'popularity', 'vote_average',
        'vote_count', 'adult', 'video',
        'tmdb_id',
    ];

    protected $casts = [
        'adult' => 'boolean',
        'video' => 'boolean',
        'release_date' => 'date',
        'popularity' => 'float',
        'vote_average' => 'float',
        'vote_count' => 'integer',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): string
    {
        return $this->original_title;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getOriginalLanguage(): string
    {
        return $this->original_language;
    }

    public function getReleaseDate(): ?\Illuminate\Support\Carbon
    {
        return $this->release_date;
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

    public function hasVideo(): bool
    {
        return $this->video;
    }

    public function getTmdbId(): int
    {
        return $this->tmdb_id;
    }
}
