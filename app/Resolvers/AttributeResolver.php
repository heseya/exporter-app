<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AttributeResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $attribute = Collection::make(Arr::get($response, 'attributes', []))->firstWhere(
            'name',
            Str::of($field->valueKey)->after(' ')->trim()->toString(),
        );

        return (string) Arr::get($attribute, 'selected_options.0.name', '');
    }
}
