<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Swagger\MainController;

/**
 * @OA\Schema(
 *      schema="User",
 *      required={"id","name","email","email_verified_at","created_at","updated_at"},
 *      @OA\Property(property="id", type="integer"),
 *      @OA\Property(property="name", type="string"),
 *      @OA\Property(property="email", type="string"),
 *      @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
 *      @OA\Property(property="created_at", type="string", format="date-time"),
 *      @OA\Property(property="updated_at", type="string", format="date-time"),
 *      example={"id": 1, "name": "John Doe", "email": "jHrQH@example.com", "email_verified_at": null, "created_at": "2024-01-01T00:00:00.000000Z", "updated_at": "2024-01-01T00:00:00.000000Z"}
 *  )
 */
class User extends MainController
{

}
