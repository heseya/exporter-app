<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FrontController extends Controller
{
    public function show(string $file): StreamedResponse
    {
        $file = Str::of($file)->trim('/');

        return Storage::disk('front')->download($file);
    }
}
