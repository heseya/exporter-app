<?php

declare(strict_types=1);

use App\Resolvers\AttributeResolver;

it('resolve field', function () {
    expect(AttributeResolver::resolve(
        mockField(new AttributeResolver(), valueKey: '#attribute sku'),
        [
            'attributes' => [
                [
                    'slug' => 'sku',
                    'selected_options' => [
                        [
                            'name' => '123123123',
                        ],
                    ],
                ],
                [
                    'slug' => 'test2',
                    'selected_options' => [
                        [
                            'name' => 'test-value2',
                        ],
                    ],
                ],
            ],
        ]))->toEqual('123123123');
});

it('resolve field when there is no attributes', function () {
    expect(AttributeResolver::resolve(
        mockField(new AttributeResolver()),
        [],
    ))->toEqual('');
});
