<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array<int, array>
     */
    public function toArray($request): array
    {
        return $this->collection->map(function ($resource) use ($request) {
            return (new ProductResource($resource))->additional($this->additional)->toArray($request);
        })->all();
    }
}
