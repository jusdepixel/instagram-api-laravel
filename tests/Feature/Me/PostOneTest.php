<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostOneTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->get('/api/me/posts/12345678910');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_error()
    {
        self::fakeProfile();
        $response = $this->get('/api/me/posts/0000000000');
        $response->assertStatus(400);
    }
}
