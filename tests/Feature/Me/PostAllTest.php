<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostCollection;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostAllTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->get('/api/me/posts');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_response_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        Cache::put('post-12345678910', self::fakePost());
        Cache::put('my-posts-123456789', new MePostCollection([Cache::get('post-12345678910')]));

        $response = $this->get('/api/me/posts');
        $response->assertStatus(200);
    }

    /**
     * @throws Exception
     */
    public function test_response_error()
    {
        self::fakeProfile();
        $response = $this->get('/api/me/posts');

        $response->assertStatus(400);

        $response->assertJson(fn (AssertableJson $json) =>
        $json
            ->where('message', "Bad or expired Instagram token, log in to Instagram")
        );
    }
}
