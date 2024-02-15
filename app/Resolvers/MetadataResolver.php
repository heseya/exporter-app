<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MetadataResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        return Str::of(Arr::get(
            Arr::get($response, 'metadata', []),
            Str::of($field->valueKey)->after(' ')->trim()->toString(),
            '',
        ))->toString();
    }
}
