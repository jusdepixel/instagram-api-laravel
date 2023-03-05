<?php

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class DeleteTest extends Instagram
{
    public function test_middleware_success()
    {
        $this->seed(InstagramSeeder::class);
        $response = $this->delete('/api/me/delete');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_status_success()
    {
        self::fakeProfile();
        $this->seed(InstagramSeeder::class);
        $response = $this->delete('/api/me/delete');
        $response->assertStatus(204);
    }
}