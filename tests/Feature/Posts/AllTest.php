<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use database\seeders\InstagramSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

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
                ->has('posts')
                ->has('posts.count')
                ->has('posts.data.0', fn ($json) =>
                    $json
                        ->where('id', 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62')
                        ->where('author', [
                            'id' => 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62',
                            'instagram_id' => 123456789,
                            'username' => 'userName',
                        ])
                        ->where('instagram_id', 12345678910)
                        ->where('caption', 'Caption Post !')
                        ->where('media_type', 'IMAGE')
                        ->where('media_url', 'http://media.url/123456789')
                        ->where('permalink', 'https://perma.link/123456789')
                        ->where('timestamp', 1677267776)
                        ->where('thumbnail_url', 'http://thumbnail.url/12345678910')
                        ->where('created_at', '2023-02-24T19:42:56.000000Z')
                        ->where('updated_at', '2023-02-24T19:42:56.000000Z')
                )
        );
    }

    private function expires(): int
    {
        $expiresAt = 1677267776 + 1677267776;
        $diff = $expiresAt - time();

        return (int) round($diff / 86400);
    }
}
