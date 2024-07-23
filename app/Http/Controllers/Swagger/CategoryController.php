<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Swagger\MainController;
use App\Http\Controllers\Swagger\Category;
use App\Http\Controllers\Swagger\Product;

/**
 * @OA\Tag(
 *     name="Categories",
 *     description="API Endpoints of Categories"
 * )
 *
 * @OA\Get(
 *     path="/api/v1/categories",
 *     summary="Get list of categories",
 *     tags={"Categories"},
 *     @OA\Response(
 *         response="200",
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Category"),
 *         ),
 *     )
 * )
 *
 * @OA\Get(
 *      path="/api/v1/categories/{category}",
 *      summary="Get a single category",
 *      tags={"Categories"},
 *      @OA\Parameter(
 *           in="path",
 *           name="category",
 *           required=true,
 *           @OA\Schema(
 *               type="integer",
 *               example=1,
 *           ),
 *           description="Category ID",
 *       ),
 *      @OA\Response(
 *          response="200",
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              allOf={@OA\Schema(ref="#/components/schemas/Category")},
 *          ),
 *      )
 *  )
 *
 * @OA\Post(
 *      path="/api/v1/categories",
 *      summary="Create new category",
 *      tags={"Categories"},
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              required={"name"},
 *              @OA\Property(property="name", type="string"),
 *                  example={"name": "test"},
 *          ),
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer"),
 *              @OA\Property(property="name", type="string"),
 *              example={"id": 1, "name": "test"},
 *          ),
 *      ),
 *  )
 *
 * @OA\Put(
 *      path="/api/v1/categories/{category}",
 *      summary="Update category",
 *      tags={"Categories"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          in="path",
 *          name="category",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Category ID",
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/CategoryRequest")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/CategoryShow")
 *      )
 *  )
 *
 * @OA\Delete(
 *      path="/api/v1/categories/{category}",
 *      summary="Delete category",
 *      tags={"Categories"},
 *      security={{"bearerAuth":{}}},
 *      @OA\Parameter(
 *          in="path",
 *          name="category",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Category ID",
 *      ),
 *      @OA\Response(
 *          response=204,
 *          description="Successful operation",
 *      )
 * )
 *
 * @OA\Get(
 *      path="/api/v1/categories/{category}/products",
 *      summary="Get list of products by category",
 *      tags={"Categories"},
 *      @OA\Parameter(
 *          in="path",
 *          name="category",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              example=1,
 *          ),
 *          description="Category ID",
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/Product")
 *          )
 *       )
 *  )
 *
 */


class CategoryController extends MainController
{

}
