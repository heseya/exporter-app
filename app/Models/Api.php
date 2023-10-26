<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\ApiDeleted;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperApi
 */
class Api extends Model
{
    use HasUuid;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => ApiDeleted::class,
    ];

    protected $fillable = [
        'url',
        'version',
        'licence_key',
        'integration_token',
        'refresh_token',
        'uninstall_token',
    ];

    public function feeds(): HasMany
    {
        return $this->hasMany(Feed::class);
    }
}
