<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Posts;

use Illuminate\Support\Facades\Cache;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostCollection;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

final class AllController
{
    public function __invoke(): PostCollection
    {
        if (!Cache::has('all-posts')) {
            Cache::add('all-posts', new PostCollection(
                InstagramPost::with('instagram_user')->get()
            ));
        }

        return Cache::get('all-posts');
    }
}
