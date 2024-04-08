<?php

namespace Tests\Feature\LocalResolvers;

use App\Resolvers\FirstMetadataOrFieldResolver;

it('resolve field', function () {
    expect(FirstMetadataOrFieldResolver::resolve(mockField(new FirstMetadataOrFieldResolver(), valueKey: '#first_metadata_or_field magento_id'), [
        'id' => 'test',
        'metadata' => [
            'magento_id' => '123',
        ],
    ]))->toEqual('123');
});

it('resolve field more metadata', function () {
    expect(FirstMetadataOrFieldResolver::resolve(mockField(new FirstMetadataOrFieldResolver(), valueKey: '#first_metadata_or_field magento_id external_id'), [
        'id' => 'test',
        'metadata' => [
            'magento_id' => '123',
            'external_id' => '456',
        ],
    ]))->toEqual('123');
});

it('resolve field only second metadata', function () {
    expect(FirstMetadataOrFieldResolver::resolve(mockField(new FirstMetadataOrFieldResolver(), valueKey: '#first_metadata_or_field magento_id external_id'), [
        'id' => 'test',
        'metadata' => [
            'external_id' => '456',
        ],
    ]))->toEqual('456');
});

it('resolve field when no metadata', function () {
    expect(FirstMetadataOrFieldResolver::resolve(mockField(new FirstMetadataOrFieldResolver(), valueKey: '#first_metadata_or_field magento_id'), [
        'id' => 'test',
    ]))->toEqual('test');
});

it('resolve field when no metadata custom field', function () {
    expect(FirstMetadataOrFieldResolver::resolve(mockField(new FirstMetadataOrFieldResolver(), valueKey: '#first_metadata_or_field magento_id;name'), [
        'id' => 'test',
        'name' => 'name field'
    ]))->toEqual('name field');
});
