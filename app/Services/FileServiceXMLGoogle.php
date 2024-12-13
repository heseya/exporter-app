<?php

namespace App\Services;

use App\Models\Feed;
use App\Models\Field;
use App\Resolvers\AdditionalSectionResolver;
use App\Resolvers\LocalResolver;
use App\Services\Contracts\FileServiceContract;
use Illuminate\Support\Str;

final class FileServiceXMLGoogle implements FileServiceContract
{
    public function buildHeader(Feed $feed): string
    {
        return '<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0">';
    }

    /**
     * @param Field[] $fields
     */
    public function buildRow(array $fields, array $response): string
    {
        $cells = ['<entry>'];

        foreach ($fields as $field) {
            if ($field->resolver instanceof AdditionalSectionResolver) {
                continue;
            }
            $value = Str::of($field->resolver instanceof LocalResolver ?
                $field->getLocalValue($response) :
                $field->getGlobalValue());

            if ($field->resolver::ESCAPE) {
                $value = $value
                    ->replace('', '')
                    ->start('<![CDATA[')
                    ->append(']]>');
            }

            $cells[] = $value
                ->start("<{$field->key}>")
                ->append("</{$field->key}>")
                ->toString();
        }

        $cells[] = '</entry>';

        return implode('', $cells);
    }

    public function buildEnding(Feed $feed): string
    {
        return '</feed>';
    }

    public function buildAdditionalData(array $fields): string
    {
        return '';
    }
}
