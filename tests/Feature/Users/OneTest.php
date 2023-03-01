<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use database\seeders\InstagramSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

class OneTest extends Instagram
{
    public function test_status_success()
    {
        $this->seed(InstagramSeeder::class);
        $response = $this->get('/api/users/bac04411-0000-4cd2-b9d9-06ad4f9c1c62');

        $response->assertStatus(200);
    }

    public function test_status_error()
    {
        $this->seed(InstagramSeeder::class);
        $response = $this->get('/api/users/pas-de-uuid');

        $response->assertStatus(403);
    }

    public function test_response_success()
    {
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/users/bac04411-0000-4cd2-b9d9-06ad4f9c1c62');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('user', fn ($json) =>
                $json
                    ->where('id', 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62')
                    ->where('instagram_id', 123456789)
                    ->where('username', 'userName')
                    ->where('media_count', 42)
                    ->where('access_token', 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv')
                    ->where('token_type', 'Bearer')
                    ->where('expires_in', 1677267776)
                    ->where('created_at', '2023-02-24T19:42:56.000000Z')
                    ->where('updated_at', '2023-02-24T19:42:56.000000Z')
                    ->where('expires_in_human',  self::expiresInHuman(1677267776))
                    ->where('posts', [
                        'count' => 1,
                        'data' => [0 => [
                            'caption' => 'Caption Post !',
                            'created_at' => '2023-02-24T19:42:56.000000Z',
                            'id' => 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62',
                            'instagram_id' => 12345678910,
                            'media_type' => 'IMAGE',
                            'media_url' => 'http://media.url/123456789',
                            'permalink' => 'https://perma.link/123456789',
                            'thumbnail_url' => 'http://thumbnail.url/12345678910',
                            'timestamp' => 1677267776,
                            'updated_at' => '2023-02-24T19:42:56.000000Z',
                        ]],
                        'links' => [
                            'self' => 'http://localhost/api/posts'
                        ]
                    ])
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
