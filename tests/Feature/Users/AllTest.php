<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Users;

use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class AllTest extends Instagram
{
    public function test_status_success()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }

    public function test_response_success()
    {
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/users');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->has('count')
                ->has('links')
                ->has('users.0', fn ($json) =>
                    $json
                        ->where('id', '88888888-4444-4444-4444-121212121212')
                        ->where('username', 'username')
                        ->where('instagram_posts_count', 42)
                        ->where('shared_posts_count', 1)
                        ->where('link', '/api/users/88888888-4444-4444-4444-121212121212')
                )
        );
    }
}
