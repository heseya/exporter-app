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

it('resolve field with price initial', function () {
    expect(
        SalePriceResolver::resolve(
            mockField(new SalePriceResolver(), valueKey: 'sale_price PLN'),
            [
                'prices_min_initial' => [
                    ['gross' => '14.00', 'currency' => 'EUR'],
                    ['gross' => '40.00', 'currency' => 'PLN'],
                ],
                'prices_min' => [
                    ['gross' => '4.00', 'currency' => 'EUR'],
                    ['gross' => '10.00', 'currency' => 'PLN'],
                ],
            ],
        ),
    )->toEqual('10.00 PLN');
});

it('resolve field no sale', function () {
    expect(
        SalePriceResolver::resolve(
            mockField(new SalePriceResolver(), valueKey: 'sale_price PLN'),
            [
                'prices_min_initial' => [
                    ['gross' => '4.00', 'currency' => 'EUR'],
                    ['gross' => '10.00', 'currency' => 'PLN'],
                ],
                'prices_min' => [
                    ['gross' => '4.00', 'currency' => 'EUR'],
                    ['gross' => '10.00', 'currency' => 'PLN'],
                ],
            ],
        ),
    )->toEqual('');
});

it('resolve field when there is no info', function () {
    expect(SalePriceResolver::resolve(
        mockField(new SalePriceResolver(), valueKey: 'sale_price PLN'),
        [],
    ))->toEqual('');
});
