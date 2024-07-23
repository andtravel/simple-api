<?php

namespace App\Http\Controllers\Swagger;

/**
 * @OA\Schema(
 *        schema="Category",
 *        required={"id", "name", "products"},
 *        @OA\Property(
 *            property="id",
 *            type="integer",
 *            description="ID",
 *            example=1
 *        ),
 *        @OA\Property(
 *            property="name",
 *            type="string",
 *            description="Name"
 *        ),
 *        @OA\Property(
 *            property="products",
 *            type="array",
 *            description="Products",
 *            @OA\Items(ref="#/components/schemas/Product")
 *        ),
 * )
 *
 * @OA\Schema(
 *      schema="CategoryShow",
 *      required={"id", "name", "products"},
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          example=1
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *          example="test"
 *      ),
 *      @OA\Property(
 *          property="products",
 *          type="array",
 *              @OA\Items(
 *                  ref="#/components/schemas/Product"
 *              ),
 *      ),
 * )
 *
 * @OA\Schema(
 *      schema="CategoryRequest",
 *      required={"id", "name", "products"},
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="products",
 *          type="array",
 *              @OA\Items(type="integer"),
 *      ),
 *      example={
 *          "id": 1,
 *          "name": "test",
 *          "products": {1, 2}
 *      }
 *  )
 */

class Category
{

}
