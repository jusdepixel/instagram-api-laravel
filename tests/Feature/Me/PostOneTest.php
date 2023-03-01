<?php

declare(strict_types=1);

namespace Tests\Feature\Me;

use database\seeders\InstagramSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

class PostOneTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->get('/api/me/posts/12345678910');
        $response->assertStatus(403);
    }

    public function test_status_error()
    {
        self::fakeProfile();
        $response = $this->get('/api/me/posts/0000000000');
        $response->assertStatus(400);
    }

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
                        ->where('instagram_user_id', 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62')
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
