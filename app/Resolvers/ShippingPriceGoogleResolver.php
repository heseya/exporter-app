<?php

namespace App\Resolvers;

use App\Models\Field;
use App\Services\Contracts\ApiServiceContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ShippingPriceGoogleResolver implements GlobalResolver
{
    public const ESCAPE = false;

    public static function resolve(Field $field): string
    {
        [$country, $currency] = explode(' ', Str::of($field->valueKey)->after(' ')->toString());
        $apiService = App::make(ApiServiceContract::class);

        $response = $apiService->get($field->feed->api, '/shipping-methods');
        $shippingMethods = $response->json('data');

        $minShippingPrice = array_reduce(
            $shippingMethods,
            function ($carry, $item) use ($currency) {
                $prices = collect(Arr::get($item, 'prices'));
                $price = Arr::get(
                    $prices->firstWhere('currency', '=', $currency),
                    'gross',
                );

                return $carry === null || $price < $carry ? $price : $carry;
            },
        ) ?? 0;

        return "<g:country><![CDATA[{$country}]]></g:country><g:price><![CDATA[{$minShippingPrice} {$currency}]]></g:price>";
    }
}
