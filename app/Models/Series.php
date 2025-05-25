<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
