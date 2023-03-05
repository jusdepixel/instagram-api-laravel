<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Me;

use Exception;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostCreateTest extends Instagram
{
    public function test_middleware_success()
    {
        $response = $this->post('/api/me/posts/12345678910');
        $response->assertStatus(403);
    }

    /**
     * @throws Exception
     */
    public function test_response_error()
    {
        self::fakeProfile();
        $response = $this->post('/api/me/posts/12345678910');
        $response->assertStatus(400);
    }
}
