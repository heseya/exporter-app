<?php

namespace App\Providers;

use App\Events\ApiDeleted;
use App\Listeners\DeleteFeedsAfterDeletingApi;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        ApiDeleted::class => [
            DeleteFeedsAfterDeletingApi::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
