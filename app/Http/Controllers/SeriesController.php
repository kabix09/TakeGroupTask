<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Series;
use OpenApi\Annotations as OA;

final class SeriesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/series",
     *     operationId="getSeriesList",
     *     tags={"Series"},
     *     summary="Get list of TV series",
     *     description="Returns list of TV series with genres",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Series")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $movies = Series::with('genres')->get();
        return response()->json($movies);
    }

    /**
     * @OA\Get(
     *     path="/api/series/{id}",
     *     operationId="getSeriesDetail",
     *     tags={"Series"},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the movie",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Series detail",
     *         @OA\JsonContent(ref="#/components/schemas/Series")
     *     )
     * )
     */
    public function get(int $id)
    {
        $movie = Series::with('genres')->findOrFail($id);
        return response()->json($movie);
    }
}
