<?php

namespace Tests\Feature\GlobalResolvers;

use App\Resolvers\ShippingPriceGoogleResolver;
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

    expect(ShippingPriceGoogleResolver::resolve(
        mockField(new ShippingPriceGoogleResolver(), valueKey: '@shipping_price_google PL PLN')),
    )->toBe('<g:country><![CDATA[PL]]></g:country><g:price><![CDATA[10.00 PLN]]></g:price>');
});
