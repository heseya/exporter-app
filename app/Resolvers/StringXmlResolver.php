<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Str;

class StringXmlResolver implements GlobalResolver
{
    public const ESCAPE = false;

    public static function resolve(Field $field): string
    {
        return Str::of($field->valueKey)->after(' ')->toString();
    }
}
