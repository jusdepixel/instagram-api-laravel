<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts;

use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Exception;
use Illuminate\Http\Response;

final class OneController
{
    public function __invoke(string $id): Response|PostResource
    {
        $post = new PostResource(
            InstagramPost::query()->with('author')->find($id)
        );

        if ($post) {
            return $post;
        } else {
            return (new InstagramException())->render(
                new Exception("This post does not exist or no longer exists", 404)
            );
        }
    }
}
