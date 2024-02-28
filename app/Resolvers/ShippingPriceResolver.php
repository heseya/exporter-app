<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use App\Services\Contracts\ApiServiceContract;
use Illuminate\Support\Facades\App;

class ShippingPriceResolver implements GlobalResolver
{
    public static function resolve(Field $field): string
    {
        $apiService = App::make(ApiServiceContract::class);

        $response = $apiService->get($field->feed->api, '/shipping-methods');
        $shippingMethods = $response->json('data');

        $minShippingPrice = array_reduce(
            $shippingMethods,
            function ($carry, $item) {
                if (
                    $item['shipping_type'] !== 'digital'
                    && $item['public'] === true
                    && ($carry === null || $item['price'] < $carry)
                ) {
                    return $item['price'];
                }

                return $carry;
            },
        ) ?? 0;

        return "PL:{$minShippingPrice} PLN";
    }
}
