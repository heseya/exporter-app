<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MetadataPrivateResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        return Arr::get(
            Arr::get($response, 'metadata', []),
            Str::of($field->valueKey)->after(' ')->trim(),
        );
    }
}
