<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Profile;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Support\Facades\Cache;

final class UserCacheAction
{
    public function __construct()
    {
        $id = (new Profile)::getProfile()->instagram_id;

        Cache::delete("my-posts-" . $id);
        Cache::delete("my-profile-" . $id);

        $postsUser = InstagramPost::query()
            ->select('instagram_id')
            ->where('instagram_user_id', (new Profile)::getProfile()->instagram_user_id)
            ->get();

        $postsUser->each(function ($post) {
            Cache::delete("post-" . $post->instagram_id);
        });
    }
}
