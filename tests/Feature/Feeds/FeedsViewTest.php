<?php

declare(strict_types=1);

use App\Enums\FileFormat;
use App\Models\Feed;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('doesn\'t show feeds when unauthorized', function () {
    getJson('/feeds')->assertForbidden();
});

it('shows feeds', function () {
    $api = mockApi();
    actingAs(mockUser($api));

    $feed = $api->feeds()->create([
        'name' => 'Test Feed',
        'format' => FileFormat::CSV->value,
        'query' => '/products',
        'fields' => '{}',
    ]);

    // This one should be hidden, since it belongs to different api.
    Feed::query()->create([
        'api_id' => mockApi()->getKey(),
        'name' => 'Test Feed 1',
        'query' => '/products',
        'fields' => '{}',
    ]);

    getJson('/feeds')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment([
            'id' => $feed->getKey(),
            'name' => 'Test Feed',
            'format' => FileFormat::CSV->value,
            'query' => '/products',
            'fields' => '{}',
        ]);
});
