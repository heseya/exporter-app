<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class InfoController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::json([
            "name" => "Facebook/Instagram Catalogue",
            "author" => "Heseya",
            "version" => "0.1.0",
            "api_version" => "^2.0.0",
            "description" => "Application lets you put your products on Facebook/Instagram marketplace",
            "icon" => "https://picsum.photos/200",
            "licence_required" => true,
            "required_permissions" => [
                "products.show",
                "products.show_details",
            ],
            "internal_permissions" => [
                [
                    "name" => "config",
                    "description" => "Allows to configure the app",
                    "display_name" => "Facebook/Instagram catalogue configuration",
                ],
            ],
        ]);
    }
}
