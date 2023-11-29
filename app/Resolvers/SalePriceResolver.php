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
        return PriceResolver::resolvePrice($field, $response, 'prices_min');
    }
}
