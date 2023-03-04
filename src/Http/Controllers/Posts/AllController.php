<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostCollection;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

final class AllController
{
    public function __invoke(): PostCollection
    {
        return new PostCollection(
             InstagramPost::query()->with('instagram_user')->get()
        );
    }
}
