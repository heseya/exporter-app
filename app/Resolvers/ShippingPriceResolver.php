<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use App\Services\Contracts\ApiServiceContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ShippingPriceResolver implements GlobalResolver
{
    public static function resolve(Field $field): string
    {
        $currency = Str::of($field->valueKey)->after(' ')->toString();
        $apiService = App::make(ApiServiceContract::class);

        $response = $apiService->get($field->feed->api, '/shipping-methods');
        $shippingMethods = $response->json('data');

        $minShippingPrice = array_reduce(
            $shippingMethods,
            function ($carry, $item) use ($currency) {
                $prices = collect(Arr::get($item, 'prices'));
                $price = $prices->firstWhere('currency', '=', $currency);

                return $carry === null || $price < $carry ? $price : $carry;
            },
        ) ?? 0;

        return "PL:{$minShippingPrice} {$currency}";
    }
}
