<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Feed;
use Illuminate\Console\Command;

interface RefreshServiceContract
{
    public function refreshFeed(Feed $feed, ?Command $command): void;
}
