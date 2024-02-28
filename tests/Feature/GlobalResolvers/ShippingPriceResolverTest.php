<?php

declare(strict_types=1);

use App\Resolvers\ShippingPriceResolver;
use Illuminate\Support\Facades\Http;

it('resolves field', function () {
    Http::fake([
        '*' => [
            'data' => [
                [
                    'public' => true,
                    'price' => 10,
                    'shipping_type' => 'digital', // digital shipping
                ],
                [
                    'public' => true,
                    'price' => 20,
                    'shipping_type' => 'address',
                ],
                [
                    'public' => false, // not public
                    'price' => 10,
                    'shipping_type' => 'address',
                ],
                [
                    'public' => true,
                    'price' => 15,
                    'shipping_type' => 'address',
                ],
                [
                    'public' => true,
                    'price' => 18,
                    'shipping_type' => 'address',
                ],
            ],
        ],
    ]);

    expect(ShippingPriceResolver::resolve(mockField(new ShippingPriceResolver())))->toBe('PL:15 PLN');
});
