<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Refresh;

use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostTest extends Instagram
{
    public function test_status_error_403()
    {
        $response = $this->patch('/api/refresh/post/12345678910');

        $response->assertStatus(403);
        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('message', 'Log in to Instagram to access this page')
        );
    }

    /**
     * @throws \Exception
     */
    public function test_status_response_error_400()
    {
        self::fakeProfile();
        $response = $this->patch('/api/refresh/post/12345678910');

        $response->assertStatus(400);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'Bad or expired Instagram token, log in to Instagram')
        );
    }

    /**
     * @throws \Exception
     */
    public function test_response_error()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);
        $response = $this->patch('/api/refresh/post/12345678910');

        $response->assertStatus(400);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'This post is not yours')
        );
    }
}
