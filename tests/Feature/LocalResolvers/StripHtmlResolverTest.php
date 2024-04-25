<?php

namespace Tests\Feature\LocalResolvers;

use App\Resolvers\StripHtmlResolver;

it('resolve field', function () {
    expect(StripHtmlResolver::resolve(mockField(new StripHtmlResolver(), valueKey: '#strip_html description_html'), [
        'id' => 'test',
        'description_html' => '<h1>Nagłówek</h1>
<p>Lorem ipsum.</p>',
    ]))->toEqual('Nagłówek
Lorem ipsum.');
});

it('resolve nested field', function () {
    expect(StripHtmlResolver::resolve(mockField(new StripHtmlResolver(), valueKey: '#strip_html metadata.description'), [
        'id' => 'test',
        'metadata' => [
            'description' => '<p>Lorem ipsum.</p>',
        ],
    ]))->toEqual('Lorem ipsum.');
});

it('resolve space after tag', function () {
    expect(StripHtmlResolver::resolve(mockField(new StripHtmlResolver(), valueKey: '#strip_html metadata.description'), [
        'id' => 'test',
        'metadata' => [
            'description' => '<p>Lorem ipsum.</p><p>Next paragraph</p>',
        ],
    ]))->toEqual('Lorem ipsum. Next paragraph');
});
