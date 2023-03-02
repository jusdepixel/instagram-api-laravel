<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostCreateTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->post('/api/me/posts/12345678910');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_success()
    {
        self::fakeProfile();
        $response = $this->post('/api/me/posts/12345678910');
        $response->assertStatus(201);
    }

    /**
     * @throws Exception
     */
    public function test_status_repost()
    {
        self::fakeProfile();
        $this->post('/api/me/posts/12345678910');
        $response = $this->post('/api/me/posts/12345678910');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('message', 'Post already exists')
                ->has('post', fn ($json) =>
                    $json
                        ->whereType('id', 'string')
                        ->where('instagram_id', 12345678910)
                        ->where('instagram_user_id', '88888888-4444-4444-4444-121212121212')
                        ->where('caption', 'Caption Post !')
                        ->where('media_type', 'IMAGE')
                        ->where('media_url', 'http://media.url/12345678910')
                        ->where('permalink', 'https://perma.link/12345678910')
                        ->where('username', 'userName')
                        ->where('timestamp', 1677267776)
                )
        );
    }
}
