<?php

namespace Tests\Feature\LocalResolvers;

use App\Resolvers\MetadataIdResolver;

it('resolve field', function () {
    expect(MetadataIdResolver::resolve(mockField(new MetadataIdResolver(), valueKey: '#metadata_id magento_id'), [
        'id' => 'test',
        'metadata' => [
            'magento_id' => '123',
        ],
    ]))->toEqual('123');
});

it('resolve field more metadata', function () {
    expect(MetadataIdResolver::resolve(mockField(new MetadataIdResolver(), valueKey: '#metadata_id magento_id external_id'), [
        'id' => 'test',
        'metadata' => [
            'magento_id' => '123',
            'external_id' => '456',
        ],
    ]))->toEqual('123');
});

it('resolve field only second metadata', function () {
    expect(MetadataIdResolver::resolve(mockField(new MetadataIdResolver(), valueKey: '#metadata_id magento_id external_id'), [
        'id' => 'test',
        'metadata' => [
            'external_id' => '456',
        ],
    ]))->toEqual('456');
});

it('resolve field when no metadata', function () {
    expect(MetadataIdResolver::resolve(mockField(new MetadataIdResolver(), valueKey: '#metadata_id magento_id'), [
        'id' => 'test',
    ]))->toEqual('test');
});
