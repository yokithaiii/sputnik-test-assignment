<?php

namespace App\Services;

use InvalidArgumentException;

/**
 * Service for handling currency conversion and price formatting.
 */
class CurrencyConverter
{
    /**
     * Convert price and format it
     *
     * @param float $price
     * @param string $currency
     * @return string
     */
    public function convertAndFormat(float $price, string $currency): string
    {
        $rates = config('currencies.rates');
        $symbols = config('currencies.symbols');

        if (!isset($rates[$currency])) {
            throw new InvalidArgumentException("Invalid currency: {$currency}");
        }

        $convertedPrice = $price / $rates[$currency];

        return match ($currency) {
            'USD', 'EUR' => $symbols[$currency] . number_format($convertedPrice, 2),
            'RUB' => number_format($convertedPrice, 0, '.', ' ') . $symbols[$currency],
            default => throw new InvalidArgumentException("Unsupported currency: {$currency}"),
        };
    }
}
