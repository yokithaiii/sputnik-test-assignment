<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * Get all products.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Product::all();
    }
}
