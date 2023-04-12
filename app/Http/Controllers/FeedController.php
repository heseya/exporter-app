<?php

namespace App\Http\Controllers;

use App\Dtos\FeedStoreDto;
use App\Http\Requests\FeedStoreRequest;
use App\Http\Resources\FeedResource;
use App\Models\Feed;
use App\Services\Contracts\FeedServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

class FeedController extends Controller
{
    public function __construct(
        private readonly FeedServiceContract $feedService,
    ) {
    }

    public function show(Request $request): AnonymousResourceCollection
    {
        return FeedResource::collection(
            $this->feedService->get($request->user()->api),
        );
    }

    public function store(FeedStoreRequest $request): JsonResource
    {
        return FeedResource::make($this->feedService->create(
            FeedStoreDto::fromRequest($request),
            $request->user()->api,
        ));
    }

    public function destroy(Request $request, Feed $feed): \Illuminate\Http\Response
    {
        $this->feedService->delete($feed, $request->user()->api);

        return Response::noContent();
    }
}
