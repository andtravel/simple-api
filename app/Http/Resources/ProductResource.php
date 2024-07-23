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
            'quantity' => $this->quantity
            ];

        if (! $request->routeIs(
            'categories.show',
            'categories.index',
            'categories.update',
            'categories.products')) {
                $data += ['categories' => $this->categories
                    ->map(fn ($category) => [ 'id' => $category->id, 'name' => $category->name])];
        }

        return $data;
    }
}
