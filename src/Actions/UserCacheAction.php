<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Profile;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Support\Facades\Cache;

/**
 * Remove all user datas
 * @package Jusdepixel\InstagramApiLaravel\Actions\UserCacheAction
 */
final class UserCacheAction
{
    public function __construct()
    {
        $profile = new Profile();
        $id = $profile::getProfile()->instagramId;

        Cache::delete("my-posts-" . $id);
        Cache::delete("my-profile-" . $id);

        $postsUser = InstagramPost::query()
            ->select('instagram_id')
            ->where('instagram_user_id', $id)
            ->get();

        foreach ($postsUser as $postCacheToDelete) {
            Cache::delete("post-" . $postCacheToDelete->instagram_id);
        }
    }
}
