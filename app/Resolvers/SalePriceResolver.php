<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SalePriceResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $currency = Str::of($field->valueKey)->after(' ')->toString();

        $initial_price = self::getPrice($response, 'prices_min_initial', $currency);
        $sale_price = self::getPrice($response, 'prices_min', $currency);

        return $sale_price !== $initial_price ? "{$sale_price} {$currency}" : '';
    }

    private static function getPrice(array $response, string $field_name, string $currency): string
    {
        $prices = collect(Arr::get($response, $field_name));

        return Arr::get(
            $prices->firstWhere('currency', '=', $currency),
            'gross',
            '0.00',
        );
    }
}
