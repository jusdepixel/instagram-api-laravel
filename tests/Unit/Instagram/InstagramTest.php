<?php

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Instagram;

use Exception;
use Illuminate\Support\Facades\Cache;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostCollection;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class InstagramTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_posts_all_exception()
    {
        $this->expectException(Exception::class);
        self::$instagram::getPosts();
    }

    /**
     * @throws Exception
     */
    public function test_posts_one_exception()
    {
        $this->expectException(Exception::class);
        self::$instagram::getPost(12345678910);
    }

    /**
     * @throws Exception
     */
    public function test_result_one_post()
    {
        Cache::put('post-12345678910', self::fakePost());
        $result = self::$instagram::getPost(12345678910);

        $this->assertEquals(Cache::get('post-12345678910'), $result);
    }

    /**
     * @throws Exception
     */
    public function test_result_all_posts()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        Cache::put('post-12345678910', self::fakePost());
        Cache::put('my-posts-123456789', new MePostCollection([Cache::get('post-12345678910')]));

        $this->assertEquals(
            Cache::get('my-posts-123456789'),
            self::$instagram::getPosts()
        );
    }
}