<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Movie;
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
    public function index()
    {
        $movies = Movie::with('genres')->get();
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
     *     @OA\Response(
     *         response=200,
     *         description="Movie detail",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     )
     * )
     */
    public function get(int $id)
    {
        $movie = Movie::with('genres')->findOrFail($id);
        return response()->json($movie);
    }
}
