<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
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
        $response = $this->get('/api/me/posts');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('posts.data.0', fn ($json) =>
                    $json
                        ->whereType('id', 'string')
                        ->where('instagram_id', 12345678910)
                        ->whereType('instagram_user_id', 'string')
                        ->where('caption', 'Caption Post !')
                        ->where('media_type', 'IMAGE')
                        ->where('media_url', 'http://media.url/12345678910')
                        ->where('permalink', 'https://perma.link/12345678910')
                        ->where('username', 'username')
                        ->where('timestamp', 1677267776)
                )
        );
    }
}
