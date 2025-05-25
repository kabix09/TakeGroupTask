<?php

declare(strict_types=1);

namespace App\Services\Translate;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Series;
use Stichoza\GoogleTranslate\GoogleTranslate as Translate;

class GoogleTranslate
{
    public function __construct()
    {
    }

    public static function movieTranslate(Movie $movie, string $language): Movie
    {
        $movie->title = Translate::trans($movie->getTitle(), $language);
        $movie->overview = Translate::trans($movie->getOverview(), $language);

        return $movie;
    }

    public static function seriesTranslate(Series $series, string $language): Series
    {
        $series->name = Translate::trans($series->getName(), $language);
        $series->overview = Translate::trans($series->getOverview(), $language);

        return $series;
    }

    public static function genreTranslate(Genre $genre, string $language): Genre
    {
        $genre->name = Translate::trans($genre->getName(), $language);

        return $genre;
    }
}
