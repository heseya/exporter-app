<?php

namespace App\Resolvers;

use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class StripHtmlResolver implements LocalResolver
{
    public static function resolve(Field $field, array $response): string
    {
        $key = Str::of($field->valueKey)->after(' ')->toString();

        return preg_replace(
            '#\s+#', ' ',
            html_entity_decode(
                strip_tags(
                    str_replace(
                        '><', '> <', Arr::get($response, $key, '')
                    )
                )
            )
        );
    }
}
