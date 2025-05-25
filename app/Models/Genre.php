<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
