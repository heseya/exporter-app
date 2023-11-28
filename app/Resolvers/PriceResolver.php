<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;

class PriceResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $prices = collect(Arr::get(
            $response,
            'price_min_initial',
            Arr::get($response, 'price_min', 0),
        ));

        return $prices->where('currency', '=', $field->valueKey) . ' ' . $field->valueKey;
    }
}
