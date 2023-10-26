<?php

namespace App\Listeners;

use App\Events\ApiDeleted;
use App\Models\Feed;

class DeleteFeedsAfterDeletingApi
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ApiDeleted $event): void
    {
        Feed::query()->where('api_id', $event->api->getKey())->delete();
    }
}
