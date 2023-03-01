<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use database\seeders\InstagramSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

class OneTest extends Instagram
{
//    public function test_status_success()
//    {
//        $this->seed(InstagramSeeder::class);
//        $response = $this->get('/api/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62');
//
//        $response->assertStatus(200);
//    }
//
//    public function test_status_error()
//    {
//        $this->seed(InstagramSeeder::class);
//        $response = $this->get('/api/posts/pas-de-uuid');
//
//        $response->assertStatus(404);
//    }

    public function test_response_success()
    {
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('post', fn($json) =>
                $json
                    ->where('id', 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62')
                    ->where('instagram_id', 12345678910)
                    ->where('author', [
                        'id' => 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62',
                        'instagram_id' => 123456789,
                        'username' => 'userName',
                    ])
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
}
