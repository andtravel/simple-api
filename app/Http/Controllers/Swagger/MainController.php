<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *      title="Catalog API Documentation",
 *      version="1.0.0",
 *      description="API documentation for Catalog of products application",
 *  )
 *
 * @OA/Server(
 *      url="http://localhost:8000",
 *      description="Local Server"
 *  )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *  )
 *
 * @OA\PathItem(
 *      path="/api/v1/",
 *      summary="Catalog API"
 *  )
 */
class MainController extends Controller
{

}
