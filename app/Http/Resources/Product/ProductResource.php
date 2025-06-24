<?php

namespace App\Http\Resources\Product;

use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    protected CurrencyConverter $currencyConverter;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->currencyConverter = app(CurrencyConverter::class);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $currency = $this->additional['currency'] ?? config('currencies.default');

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->currencyConverter->convertAndFormat((float) $this->price, $currency),
        ];
    }
}
