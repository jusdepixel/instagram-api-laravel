<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Posts;

use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class AllTest extends Instagram
{
    public function test_status_success()
    {
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
    }

    public function test_response_success()
    {
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/posts');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('links')
                ->has('count')
                ->has('posts.0', fn ($json) =>
                    $json
                        ->where('id', 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62')
                        ->where('caption', 'Caption Post !')
                        ->where('media_type', 'IMAGE')
                        ->where('media_url', 'http://media.url/123456789')
                        ->where('thumbnail_url', 'http://thumbnail.url/12345678910')
                        ->where('timestamp', '1677267776')
                        ->where('created_at', '2023-02-24T19:42:56.000000Z')
                        ->where('author', [
                            'id' => '88888888-4444-4444-4444-121212121212',
                            'username' => 'username',
                            'link' => '/api/users/88888888-4444-4444-4444-121212121212',
                        ])
                        ->where('permalink', 'https://perma.link/123456789')
                        ->where('link', '/api/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62')
                )
        );
    }
}
