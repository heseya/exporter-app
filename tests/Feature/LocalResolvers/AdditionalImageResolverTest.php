<?php

declare(strict_types=1);

use App\Resolvers\AdditionalImageResolver;

it('resolve additional image field', function () {
    expect(AdditionalImageResolver::resolve(mockField(new AdditionalImageResolver()), [
        'gallery' => [
            [
                'url' => 'http://example.com/img.png',
                'type' => 'photo',
            ],
            [
                'url' => 'http://example.com/img2.png',
                'type' => 'photo',
            ],
        ],
    ]))->toEqual('http://example.com/img2.png');
});

it('resolve additional image field when first media is video', function () {
    expect(AdditionalImageResolver::resolve(mockField(new AdditionalImageResolver()), [
        'gallery' => [
            [
                'url' => 'http://example.com/video.png',
                'type' => 'video',
            ],
            [
                'url' => 'http://example.com/img.png',
                'type' => 'photo',
            ],
            [
                'url' => 'http://example.com/video.png',
                'type' => 'video',
            ],
            [
                'url' => 'http://example.com/img2.png',
                'type' => 'photo',
            ],
        ],
    ]))->toEqual('http://example.com/img2.png');
});

it('resolve additional image field when there is no image', function () {
    expect(AdditionalImageResolver::resolve(
        mockField(new AdditionalImageResolver()),
        [],
    ))->toEqual('');
});
