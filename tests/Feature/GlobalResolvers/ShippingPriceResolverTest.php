<?php

declare(strict_types=1);

use App\Resolvers\ShippingPriceResolver;
use Illuminate\Support\Facades\Http;

it('resolves field', function () {
    Http::fake([
        '*' => [
            'data' => [
                [
                    'prices' => [
                        ['gross' => '5.00', 'currency' => 'EUR'],
                        ['gross' => '20.00', 'currency' => 'PLN'],
                    ],
                ],
                [
                    'prices' => [
                        ['gross' => '2.00', 'currency' => 'EUR'],
                        ['gross' => '10.00', 'currency' => 'PLN'],
                    ],
                ],
                [
                    'prices' => [
                        ['gross' => '3.00', 'currency' => 'EUR'],
                        ['gross' => '15.00', 'currency' => 'PLN'],
                    ],
                ],
            ],
        ],
    ]);

    expect(ShippingPriceResolver::resolve(
        mockField(new ShippingPriceResolver(), valueKey: '@shipping_price PLN')),
    )->toBe('PL:10.00 PLN');
});
