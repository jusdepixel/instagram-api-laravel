<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostAllTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->get('/api/me/posts');
        $response->assertStatus(403);
    }
}
