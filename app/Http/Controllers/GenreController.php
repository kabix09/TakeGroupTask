<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Services\Translate\GoogleTranslate;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

final class GenreController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/genres",
     *     operationId="getGenresList",
     *     tags={"Genres"},
     *     summary="Get list of genres",
     *     description="Returns list of genres",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Genre")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    /**
     * @OA\Get(
     *     path="/api/genres/{id}",
     *     operationId="getGenreDetail",
     *     tags={"Genres"},
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
     *         description="Genre detail",
     *         @OA\JsonContent(ref="#/components/schemas/Genre")
     *     )
     * )
     */
    public function get(Request $request, int $id)
    {
        $language = $request->query('language', 'en');

        $genre = Genre::findOrFail($id);
        $genre = GoogleTranslate::genreTranslate($genre, $language);

        return response()->json($genre);
    }
}
