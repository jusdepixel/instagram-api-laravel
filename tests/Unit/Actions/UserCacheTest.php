<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Actions;

use Exception;
use Illuminate\Support\Facades\Cache;
use Jusdepixel\InstagramApiLaravel\Actions\UserCacheAction;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

final class UserCacheTest extends Instagram
{
    /**
     * @throws Exception
     */
    function test_clear_cache()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        Cache::put("my-posts-123456789", true);
        Cache::put("my-profile-123456789", true);
        Cache::put("post-12345678910", true);

        new UserCacheAction;

        $this->assertEquals(null, Cache::get("my-posts-123456789"));
        $this->assertEquals(null, Cache::get("my-profile-123456789"));
        $this->assertEquals(null, Cache::get("post-12345678910"));
    }
}