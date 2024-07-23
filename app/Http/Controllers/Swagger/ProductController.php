<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Swagger\MainController;
use App\Http\Controllers\Swagger\Product;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="API Endpoints of Products"
 * )
 *
 * @OA\Get(
 *     path="/api/v1/products",
 *     summary="Get list of products",
 *     tags={"Products"},
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ProductShow"),
 *         ),
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/v1/products",
 *     summary="Create new product",
 *     tags={"Products"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/ProductShow")
 *     )
 * )
 *
 * @OA\Get(
 *      path="/api/v1/products/{product}",
 *      summary="Get a single product",
 *      tags={"Products"},
 *      @OA\Parameter(
 *          name="product",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Product ID",
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/ProductShow")
 *      )
 *  )
 *
 * @OA\Put(
 *      path="/api/v1/products/{product}",
 *      summary="Update product",
 *      tags={"Products"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="product",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Product ID",
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/ProductRequest")
 *      ),
 *
 *      @OA\Response(
 *          response="200",
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/ProductShow"),
 *      ),
 *  )
 *
 * @OA\Delete(
 *      path="/api/v1/products/{product}",
 *      summary="Delete product",
 *      tags={"Products"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          name="product",
 *          in="path",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Product ID",
 *      ),
 *      @OA\Response(
 *          response="204",
 *          description="Successful operation",
 *      ),
 * )
 )
 */

class ProductController extends MainController
{

}
