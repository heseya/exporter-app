<?php

declare(strict_types=1);

use App\Models\Feed;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\postJson;

it('doesn\'t allow delete when unauthorized', function () {
    $feed = Feed::factory()->create(['api_id' => mockApi()->getKey()]);

    deleteJson("/feeds/{$feed->getKey()}")->assertForbidden();
});

it('doesn\'t allow delete not owned feed', function () {
    $api = mockApi();
    actingAs(mockUser($api));
    $feed = Feed::factory()->create(['api_id' => mockApi()->getKey()]);

    deleteJson("/feeds/{$feed->getKey()}")->assertForbidden();
});

it('deletes feeds', function () {
    $api = mockApi();
    actingAs(mockUser($api));
    $feed = Feed::factory()->create(['api_id' => $api->getKey()]);

    deleteJson("/feeds/{$feed->getKey()}")->assertNoContent();

    assertDatabaseMissing('feeds', [
        'id' => $feed->getKey(),
    ]);
});

it('deletes feeds after deleting Api', function () {
    $api = mockApi();
    actingAs(mockUser($api));

    $feed = Feed::factory()->create(['api_id' => $api->getKey(), 'name' => 'Feed 1']);
    $feed2 = Feed::factory()->create(['api_id' => $api->getKey(), 'name' => 'Feed 2']);

    assertDatabaseHas('feeds', [
        'id' => $feed->getKey(),
    ]);
    assertDatabaseHas('feeds', [
        'id' => $feed2->getKey(),
    ]);

    postJson('/uninstall', ['uninstall_token' => $api->uninstall_token])->assertNoContent();

    assertDatabaseMissing('feeds', [
        'id' => $feed->getKey(),
    ]);
    assertDatabaseMissing('feeds', [
        'id' => $feed2->getKey(),
    ]);
});
