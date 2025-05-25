<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Takegroup TMDB API",
 *         description="Dokumentacja API aplikacji",
 *         @OA\Contact(
 *             email="kabix.009@gmail.com"
 *         ),
 *     ),
 *     @OA\Server(
 *         url=L5_SWAGGER_CONST_HOST,
 *         description="Środowisko lokalne"
 *     )
 * )
 */
abstract class Controller
{

}
