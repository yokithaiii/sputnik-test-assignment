<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\PriceIndexRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Repositories\ProductRepository;

class ProductsController extends Controller
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get products with price converted
     *
     * @param PriceIndexRequest $request
     * @return ProductCollection
     */
    public function index(PriceIndexRequest $request): ProductCollection
    {
        $products = $this->productRepository->getAll();

        return (new ProductCollection($products))
            ->additional(['currency' => $request->getCurrency()]);
    }
}
