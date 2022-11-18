<?php

return [
    'reports' => explode(',', env('EXPORT_REPORTS')),
    'formats' => explode(',', env('EXPORT_FORMATS', 'csv')),
    'default_format' => env('EXPORT_DEFAULT_FORMATS', 'csv'),

    'products_limit' => env('PRODUCTS_LIMIT', 50),
];
