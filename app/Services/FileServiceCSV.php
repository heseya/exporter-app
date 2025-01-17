<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Feed;
use App\Resolvers\AdditionalSectionResolver;
use App\Resolvers\LocalResolver;
use App\Services\Contracts\FileServiceContract;
use Illuminate\Support\Str;

final readonly class FileServiceCSV implements FileServiceContract
{
    public function buildHeader(Feed $feed): string
    {
        return implode(',', array_keys($feed->fields)) . "\n";
    }

    public function buildRow(array $fields, array $response): string
    {
        $cells = [];

        foreach ($fields as $field) {
            if ($field->resolver instanceof AdditionalSectionResolver) {
                continue;
            }
            $value = Str::of($field->resolver instanceof LocalResolver ?
                $field->getLocalValue($response) :
                $field->getGlobalValue());

            if ($field->resolver::ESCAPE) {
                $value = $value
                    ->replace([','], '')
                    ->replace(["\n", "\r"], ' ')
                    ->replace(['"'], "'");
            }

            $cells[] = $value
                ->wrap('"', '"')
                ->toString();
        }

        return implode(',', $cells) . "\n";
    }

    public function buildEnding(Feed $feed): string
    {
        return '';
    }

    public function buildAdditionalData(array $fields): string
    {
        return '';
    }
}
