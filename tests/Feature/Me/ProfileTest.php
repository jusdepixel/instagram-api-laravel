<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class ProfileTest extends Instagram
{
    public function test_status_error()
    {
        $response = $this->get('/api/me/profile');

        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/profile');

        $response->assertStatus(200);
    }

    /**
     * @throws Exception
     */
    public function test_response_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/profile');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('id', '88888888-4444-4444-4444-121212121212')
                ->where('username', 'userName')
                ->where('media_count', 42)
                ->where('created_at', '2023-02-24T19:42:56.000000Z')
                ->where('updated_at', '2023-02-24T19:42:56.000000Z')
                ->where('link', '/api/users/88888888-4444-4444-4444-121212121212')
            );
    }
}
