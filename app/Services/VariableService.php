<?php

namespace App\Services;

use App\Enums\FieldType;
use App\Models\Field;
use App\Resolvers\CoverResolver;
use App\Resolvers\GlobalResolver;
use App\Resolvers\LocalResolver;
use App\Services\Contracts\VariableServiceContract;
use Illuminate\Support\Str;

class VariableService implements VariableServiceContract
{
    private const RESOLVERS = [
        '#cover' => CoverResolver::class,
    ];

    public function resolve(array $keys): array
    {
        $fields = [];

        foreach ($keys as $key => $valueKey) {
            $fields[] = new Field(
                $key,
                $valueKey,
                $this->resolveType($valueKey),
                $this->getResolver($valueKey),
            );
        }

        return $fields;
    }

    public function resolveType(string $key): FieldType
    {
        if (Str::of($key)->startsWith('$')) {
            return FieldType::VAR_GLOBAL;
        }

        if (Str::of($key)->startsWith('#')) {
            return FieldType::VAR_LOCAL;
        }

        return FieldType::STANDARD;
    }

    public function getResolver(string $key): GlobalResolver|LocalResolver|null
    {
        if (array_key_exists($key, self::RESOLVERS)) {
            $class = self::RESOLVERS[$key];

            return new $class();
        }

        return null;
    }
}
