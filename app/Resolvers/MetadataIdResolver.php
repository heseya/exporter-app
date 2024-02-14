<?php

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MetadataIdResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $metadata = Arr::get($response, 'metadata', []);

        if (count($metadata) > 0) {
            $keys = explode(' ', Str::of($field->valueKey)->after(' ')->toString());

            $i = 0;
            while ($i < count($keys)) {
                $result = Arr::get(
                    $metadata,
                    $keys[$i],
                    null
                );

                if ($result) {
                    return $result;
                }
                ++$i;
            }
        }

        return Arr::get($response, 'id', '');
    }
}
