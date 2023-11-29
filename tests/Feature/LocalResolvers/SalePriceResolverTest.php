<?php

declare(strict_types=1);

use App\Resolvers\SalePriceResolver;

it('resolve field', function () {
    expect(
        SalePriceResolver::resolve(
            mockField(new SalePriceResolver(), valueKey: 'sale_price PLN'),
            [
                'prices_min' => [
                    ['gross' => '4.00', 'currency' => 'EUR'],
                    ['gross' => '10.00', 'currency' => 'PLN'],
                ],
            ],
        ),
    )->toEqual('10.00 PLN');
});

it('resolve field when there is no info', function () {
    expect(SalePriceResolver::resolve(
        mockField(new SalePriceResolver(), valueKey: 'sale_price PLN'),
        [],
    ))->toEqual('0.00 PLN');
});
