<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];

        if ($request->routeIs('products.index') || $request->routeIs('products.show')) {
                $data += ['categories' => CategoryResource::collection($this->categories)
                    ->pluck('id')
                    ->map(fn ($id) => ['id' => $id, 'name' => $this->categories->where('id', $id)->first()->name])];
            }
        return $data;
    }
}
