<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Services\Translate\GoogleTranslate;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

final class MovieController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/movies",
     *     operationId="getMoviesList",
     *     tags={"Movies"},
     *     summary="Get list of movies",
     *     description="Returns list of movies with genres",
     *     @OA\Parameter(
     *         name="language",
     *         in="query",
     *         required=false,
     *         description="Optional language code (e.g., 'pl', 'de', 'en')",
     *         @OA\Schema(type="string", example="pl")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Movie")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $language = $request->query('language', 'en');

        $movies = Movie::with('genres')->get();
        foreach ($movies as $movie) {
            $movie = GoogleTranslate::movieTranslate($movie, $language);
        }

        return response()->json($movies);
    }

    /**
     * @OA\Get(
     *     path="/api/movies/{id}",
     *     operationId="getMovieDetail",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the movie",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="language",
     *         in="query",
     *         required=false,
     *         description="Optional language code (e.g., 'pl', 'de', 'en')",
     *         @OA\Schema(type="string", example="pl")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie detail",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     )
     * )
     */
    public function get(Request $request, int $id)
    {
        $language = $request->query('language', 'en');

        $movie = Movie::with('genres')->findOrFail($id);
        $movie = GoogleTranslate::movieTranslate($movie, $language);

        return response()->json($movie);
    }
}
