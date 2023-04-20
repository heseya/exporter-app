<?php

namespace App\Resolvers;

use Illuminate\Support\Arr;

class AdditionalImageResolver implements LocalResolver
{
    public static function resolve(array $response): string
    {
        $cover = true;

        foreach (Arr::get($response, 'gallery', []) as $media) {
            if (Arr::get($media, 'type') !== 'photo') {
                continue;
            }

            if ($cover) {
                $cover = false;
                continue;
            }

            return Arr::get($media, 'url', '');
        }

        return '';
    }
}
