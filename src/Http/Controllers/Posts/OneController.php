<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Response;

final class OneController
{
    public function __invoke(string $id): Response|PostResource
    {
        if ($post = InstagramPost::query()->with('author')->find($id)) {
            return new PostResource($post);
        }

        return response([
            'message' =>  'This post does not exist or no longer exists'
        ], 404);
    }
}
