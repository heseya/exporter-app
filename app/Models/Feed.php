<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperFeed
 */
class Feed extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'api_id',
        'name',
        'query',
        'refreshed_at',
        'fields',
    ];

    protected $casts = [
        'refreshed_at' => 'datetime',
        'fields' => 'array',
    ];

    public function api(): BelongsTo
    {
        return $this->belongsTo(Api::class);
    }

    public function path(): string
    {
        return "feeds/{$this->getKey()}.csv";
    }

    public function tempPath(): string
    {
        return "feeds-temp/{$this->getKey()}.csv";
    }
}
