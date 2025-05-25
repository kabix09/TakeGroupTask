<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
