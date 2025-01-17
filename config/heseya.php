<?php

declare(strict_types=1);

use Illuminate\Support\Env;

return [
    'name' => $appName = Env::get('APP_NAME', 'Exporter'),
    'author' => 'Heseya',
    'description' => Env::get('APP_DESCRIPTION'),
    'icon' => Env::get('APP_URL') . '/logo.png',
    'version' => '3.2.1',
    'api_version' => '^2.0.0',
    'microfrontend_url' => Env::get('APP_URL') . '/front',
    'licence_required' => Env::get('LICENSE_REQUIRED', false),
    'required_permissions' => [
        'auth.check_identity',
        'products.show',
        'products.show_details',
        'products.show_hidden',
        'products.show_metadata_private',
        'shipping_methods.show',
        'product_sets.show',
        'product_sets.show_hidden',
    ],
    'internal_permissions' => [
        [
            'name' => 'configure',
            'display_name' => "Permission to manage {$appName}",
            'unauthenticated' => false,
        ],
    ],
];
