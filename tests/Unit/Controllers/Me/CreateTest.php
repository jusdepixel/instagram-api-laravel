<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Controllers\Me;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostCreateController;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class CreateTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_result_error()
    {
        $response = (new PostCreateController())->__invoke(12345678910, new Request());

        $expected = '{"message":"Bad or expired Instagram token, log in to Instagram"}';
        $this->assertEquals($expected, $response->content());
    }

    /**
     * @throws Exception
     */
    public function test_result_success()
    {
        self::fakeProfile();
        Cache::put('post-12345678910', self::fakePost());
        $response = (new PostCreateController())->__invoke(12345678910, new Request);

        $expected = json_encode([
            'message' => 'Post has been added',
            'post' => new PostResource(InstagramPost::query()
                ->where('instagram_id', 12345678910)
                ->first()
            )
        ]);

        $this->assertEquals($expected, $response->content());
    }

    /**
     * @throws Exception
     */
    public function test_result_already_exist()
    {
        self::fakeProfile();
        Cache::put('post-12345678910', self::fakePost());
        (new PostCreateController())->__invoke(12345678910, new Request);
        $response = (new PostCreateController())->__invoke(12345678910, new Request);

        $expected = json_encode([
            'message' => 'Post already exists',
            'post' => self::fakePost()
        ]);

        $this->assertEquals($expected, $response->content());
    }
}
