<?php

declare(strict_types=1);

use App\Enums\FileFormat;
use App\Models\Feed;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\patchJson;

it('doesn\'t allow update when unauthorized', function () {
    $feed = Feed::factory()->create(['api_id' => mockApi()->getKey()]);

    patchJson("/feeds/{$feed->getKey()}")->assertForbidden();
});

it('doesn\'t allow update not owned feed', function () {
    $api = mockApi();
    actingAs(mockUser($api));

    $feed = Feed::factory()->create(['api_id' => mockApi()->getKey()]);

    patchJson("/feeds/{$feed->getKey()}", [
        'name' => 'New Name',
    ])->assertForbidden();

    assertDatabaseHas('feeds', [
        'id' => $feed->getKey(),
        'name' => $feed->name,
    ]);
});

it('updates feeds', function () {
    $api = mockApi();
    actingAs(mockUser($api));

    $feed = Feed::factory()->create(['api_id' => $api->getKey()]);

    patchJson("/feeds/{$feed->getKey()}", [
        'name' => 'New Name',
    ])->assertOk();

    assertDatabaseHas('feeds', [
        'id' => $feed->getKey(),
        'name' => 'New Name',
    ]);
});

it('updates feed format', function () {
    $api = mockApi();
    actingAs(mockUser($api));

    $feed = Feed::factory()->create([
        'api_id' => $api->getKey(),
        'format' => FileFormat::CSV->value,
    ]);

    patchJson("/feeds/{$feed->getKey()}", [
        'format' => FileFormat::XML->value,
    ])->assertOk();

    assertDatabaseHas('feeds', [
        'id' => $feed->getKey(),
        'format' => FileFormat::XML->value,
    ]);
});
