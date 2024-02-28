<?php

declare(strict_types=1);

use App\Resolvers\SetWithMetadataResolver;

it('resolves field', function () {
    expect(SetWithMetadataResolver::resolve(mockField(new SetWithMetadataResolver(), 'homepage'), [
        'sets' => [
            [
                'name' => 'Tests',
            ],
            [
                'name' => 'Monitors',
                'metadata' => [
                    'test' => 123,
                    'homepage' => true,
                ],
            ],
            [
                'name' => 'Peripherals',
                'metadata' => [
                    'test' => 123,
                    'homepage' => false,
                ],
            ],
        ],
    ]))->toEqual('Monitors');
});

it('resolves field when empty', function () {
    expect(SetWithMetadataResolver::resolve(mockField(new SetWithMetadataResolver()), []))
        ->toEqual('');
});
