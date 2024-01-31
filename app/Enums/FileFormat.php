<?php

declare(strict_types=1);

namespace App\Enums;

use App\Services\FileServiceCSV;
use App\Services\FileServiceXML;
use App\Services\FileServiceXMLCeneo;
use App\Services\FileServiceXMLGoogle;

enum FileFormat: string
{
    case CSV = 'csv';
    case XML = 'xml';
    case XML_GOOGLE = 'xml-google';
    case XML_CENEO = 'xml-ceneo';

    public function service(): string
    {
        return match ($this) {
            self::CSV => FileServiceCSV::class,
            self::XML => FileServiceXML::class,
            self::XML_GOOGLE => FileServiceXMLGoogle::class,
            self::XML_CENEO => FileServiceXMLCeneo::class,
        };
    }
}
