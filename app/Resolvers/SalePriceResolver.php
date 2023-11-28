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
        $prices = collect(Arr::get($response, 'price_min', 0));
        $currency = Str::of($field->valueKey)->after(' ')->toString();
        $price = Arr::get(
            $prices->firstWhere('currency', '=', $currency),
            'gross',
        );

        return "{$price} {$currency}";
    }
}
