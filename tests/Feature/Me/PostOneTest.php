<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostOneTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->get('/api/me/posts/12345678910');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_error()
    {
        self::fakeProfile();
        $response = $this->get('/api/me/posts/0000000000');
        $response->assertStatus(400);
    }

    /**
     * @throws Exception
     */
    public function test_response_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/posts/12345678910');
        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('post', fn ($json) =>
                    $json
                        ->where('id', 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62')
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
