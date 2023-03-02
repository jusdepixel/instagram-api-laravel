<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Exception;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostDeleteTest extends Instagram
{
    public function test_middleware_success()
    {
        $this->seed(InstagramSeeder::class);
        $response = $this->delete('/api/me/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);
        $response = $this->delete('/api/me/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62');
        $response->assertStatus(204);
    }

    /**
     * @throws Exception
     */
    public function test_status_error()
    {
        self::fakeProfile();
        $response = $this->delete('/api/me/posts/bac04411-9999-4cd2-b9d9-06ad4f9c1c62');
        $response->assertStatus(404);
    }
}
