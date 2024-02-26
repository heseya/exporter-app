<?php

namespace Tests\Feature\LocalResolvers;

use App\Resolvers\PriceFloatResolver;
use App\Resolvers\PromoPriceFloatResolver;

it('resolve field', function () {
    expect(PromoPriceFloatResolver::resolve(
        mockField(new PromoPriceFloatResolver(), valueKey: 'price PLN'),
        [
            'prices_min_initial' => [
                ['gross' => '4.00', 'currency' => 'EUR'],
                ['gross' => '20.00', 'currency' => 'PLN'],
            ],
            'prices_min' => [
                ['gross' => '3.00', 'currency' => 'EUR'],
                ['gross' => '15.00', 'currency' => 'PLN'],
            ],
        ],
    ))->toEqual('15.00');
});

it('resolve field no promo price', function () {
    expect(PromoPriceFloatResolver::resolve(
        mockField(new PromoPriceFloatResolver(), valueKey: 'price PLN'),
        [
            'prices_min_initial' => [
                ['gross' => '4.00', 'currency' => 'EUR'],
                ['gross' => '20.00', 'currency' => 'PLN'],
            ],
        ],
    ))->toEqual('20.00');
});

it('resolve field when there is no info', function () {
    expect(PromoPriceFloatResolver::resolve(mockField(new PriceFloatResolver(), valueKey: 'price PLN'), []))
        ->toEqual('0.00');
});
