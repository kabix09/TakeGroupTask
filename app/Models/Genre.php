<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Genre",
 *     type="object",
 *     title="Genre",
 *     required={"id", "name", "source", "tmdb_id"},

 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Horror"),
 *     @OA\Property(property="source", type="string", enum={"movie", "tv"}, example="movie"),
 *     @OA\Property(property="tmdb_id", type="integer", example=27)
 * )
 */
final class Genre extends Model
{
    protected $fillable = [
        'name',
        'source',
        'tmdb_id',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTmdbId(): int
    {
        return $this->tmdb_id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
