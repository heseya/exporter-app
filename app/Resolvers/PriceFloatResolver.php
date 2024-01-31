<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PriceFloatResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $currency = Str::of($field->valueKey)->after(' ')->toString();
        $prices = collect(Arr::get($response, 'prices_min_initial', Arr::get($response, 'prices_min')));

        return Arr::get(
            $prices->firstWhere('currency', '=', $currency),
            'gross',
            '0.00',
        );
    }
}
