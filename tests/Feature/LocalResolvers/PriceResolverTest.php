<?php

declare(strict_types=1);

use App\Resolvers\PriceResolver;

it('resolve field', function () {
    expect(PriceResolver::resolve(
        mockField(new PriceResolver(), valueKey: 'price PLN'),
        [
            'prices_min_initial' => [
                ['gross' => '4.00', 'currency' => 'EUR'],
                ['gross' => '20.00', 'currency' => 'PLN'],
            ],
        ],
    ))->toEqual('20.00 PLN');
});

it('resolve field when there is no info', function () {
    expect(PriceResolver::resolve(mockField(new PriceResolver(), valueKey: 'price PLN'), []))
        ->toEqual('0.00 PLN');
});
