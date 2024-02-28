<?php

declare(strict_types=1);

use App\Resolvers\SetWithMetadataResolver;

it('resolves field', function () {
    expect(SetWithMetadataResolver::resolve(mockField(new SetWithMetadataResolver()), [
        'sets' => [
            [
                'name' => 'Monitors',
                'metadata' => [
                    'test' => true,
                ],
            ],
            [
                'name' => 'Peripherals',
                'metadata' => [
                    'test' => false,
                ],
            ],
        ],
    ]))->toEqual('Monitors');
});

it('resolves field when empty', function () {
    expect(SetWithMetadataResolver::resolve(mockField(new SetWithMetadataResolver()), []))->toEqual('');
});
