<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PriceResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        return self::resolvePrice($field, $response, 'prices_min_initial');
    }

    public static function resolvePrice(Field $field, array $response, string $field_name): string
    {
        $currency = Str::of($field->valueKey)->after(' ')->toString();
        $prices = collect(Arr::get($response, $field_name));
        $price = Arr::get(
            $prices->firstWhere('currency', '=', $currency),
            'gross',
            '0.00',
        );

        return "{$price} {$currency}";
    }
}
