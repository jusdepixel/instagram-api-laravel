<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Illuminate\Support\Carbon;
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
    public function test_result_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);

        $response = $this->get('/api/me/profile');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('id', '88888888-4444-4444-4444-121212121212')
                ->where('username', 'username')
                ->where('instagram_id', '123456789')
                ->where('media_count', 42)
                ->where('access_token', 'iu0aMCsaepPy6ULphSX5PT32oPvKkM5dPl131knIDq9Cr8OUzzACsuBnpSJ_rE9XkGjmQVawcvyCHLiM4Kr6NA')
                ->where('expires_in', 5184000)
                ->where('expires_in_human', '60 days, 0 hours and 0 minutes')
                ->where('posts_auto', false)
                ->where('created_at', '2023-02-24T19:42:56.000000Z')
                ->where('updated_at', '2023-02-24T19:42:56.000000Z')
                ->where('link', '/api/users/88888888-4444-4444-4444-121212121212')
            );
    }
}
