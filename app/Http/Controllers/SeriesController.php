<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Series;
use App\Services\Translate\GoogleTranslate;
use Illuminate\Http\Request;
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
        $series = Series::with('genres')->get();
        return response()->json($series);
    }

    /**
     * @OA\Get(
     *     path="/api/series/{id}",
     *     operationId="getSeriesDetail",
     *     tags={"Series"},
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
     *         description="Series detail",
     *         @OA\JsonContent(ref="#/components/schemas/Series")
     *     )
     * )
     */
    public function get(Request $request, int $id)
    {
        $language = $request->query('language', 'en');

        $series = Series::with('genres')->findOrFail($id);
        $series = GoogleTranslate::seriesTranslate($series, $language);

        return response()->json($series);
    }
}
