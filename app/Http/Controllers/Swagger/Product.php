<?php

namespace App\Http\Controllers\Swagger;

/**
 * @OA\Schema(
 *      schema="Product",
 *      required={"id","name","description","price","quantity"},
 *      @OA\Property(property="id", type="integer"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="description", type="string"),
 *      @OA\Property(property="price", type="number", format="float"),
 *      @OA\Property(property="quantity", type="number", format="integer"),
 *      example={"id": 1, "name": "Product 1", "description": "Product 1 description", "price": 100, "quantity": 10}
 *  )
 *
 * @OA\Schema(
 *       schema="ProductShow",
 *       required={"id","name","description","price","quantity","categories"},
 *       @OA\Property(property="id", type="integer", example=1),
 *       @OA\Property(property="name", type="string", example="Product 1"),
 *       @OA\Property(property="description", type="string", example="Product 1 description"),
 *       @OA\Property(property="price", type="number", format="float", example=100),
 *       @OA\Property(property="quantity", type="number", format="integer", example=10),
 *       @OA\Property(property="categories", type="array",
 *           @OA\Items(
 *               @OA\Property(property="id", type="integer", example=1),
 *               @OA\Property(property="name", type="string", example="Category 1"),
 *           ),
 *       ),
 *   )
 *
 * @OA\Schema(
 *      schema="ProductRequest",
 *      required={"name","description","price","quantity","categories"},
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="description", type="string"),
 *      @OA\Property(property="price", type="number", format="float"),
 *      @OA\Property(property="quantity", type="number", format="integer"),
 *      @OA\Property(property="categories", type="array", @OA\Items(type="integer")),
 *      example={"name": "Product 1", "description": "Product 1 description", "price": 100, "quantity": 10, "categories": {1, 2}}
 *  )
 */

class Product
{

}
