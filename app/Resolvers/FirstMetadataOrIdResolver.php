<?php

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * This resolver retrieves the first existing product metadata
 * based on the metadata names provided when defining feed fields.
 * Metadata names should be provided separated by spaces.
 * If none of the mentioned metadata is present in the product's metadata, the product ID value will be used.
 */
class FirstMetadataOrIdResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $metadata = Arr::get($response, 'metadata', []);

        if (count($metadata) > 0) {
            $keys = explode(' ', Str::of($field->valueKey)->after(' ')->toString());

            foreach ($keys as $key) {
                $result = Arr::get(
                    $metadata,
                    $key,
                    null
                );

                if ($result) {
                    return $result;
                }
            }
        }

        return Arr::get($response, 'id', '');
    }
}
