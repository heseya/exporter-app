<?php

namespace App\Services;

use App\Models\Feed;
use App\Models\Field;
use App\Resolvers\LocalResolver;
use App\Services\Contracts\FileServiceContract;
use Illuminate\Support\Str;

final class FileServiceXMLCeneo implements FileServiceContract
{
    public function buildHeader(Feed $feed): string
    {
        return '<?xml version="1.0" encoding="utf-8"?><offers xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1">';
    }

    /**
     * @param Field[] $fields
     */
    public function buildRow(array $fields, array $response): string
    {
        $cells = ['<o>'];

        $oElements = ['id', 'url', 'price', 'avail'];
        $oData = [];

        foreach ($fields as $field) {
            $value = Str::of($field->resolver instanceof LocalResolver ?
                $field->getLocalValue($response) :
                $field->getGlobalValue());

            if (in_array($field->key, $oElements)) {
                $oData[] = $field->key . '="' . $value . '"';
            }

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
        if (count($oData) > 0) {
            $cells[0] = '<o ' . implode(' ', $oData) . '>';
        }

        $cells[] = '</o>';

        return implode('', $cells);
    }

    public function buildEnding(Feed $feed): string
    {
        return '</offers>';
    }
}
