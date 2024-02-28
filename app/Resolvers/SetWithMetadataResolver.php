<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;

class SetWithMetadataResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $hasCustomLabel = fn ($set) => array_key_exists('metadata', $set)
            && array_key_exists($field->valueKey, $set['metadata'])
            && $set['metadata'][$field->valueKey] === true;

        $customLabelSets = array_values(array_filter($response['sets'] ?? [], $hasCustomLabel));

        return (string) Arr::get($customLabelSets, '0.name', '');
    }
}
