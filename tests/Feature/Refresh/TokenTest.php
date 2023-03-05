<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Refresh;

use Exception;
use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class TokenTest extends Instagram
{
    public function test_status_error_403()
    {
        $response = $this->patch('/api/refresh/token');

        $response->assertStatus(403);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'Log in to Instagram to access this page')
        );
    }

    /**
     * @throws Exception
     */
    public function test_status_response_error_400()
    {
        self::fakeProfile();
        $response = $this->patch('/api/refresh/token');

        $response->assertStatus(400);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('message', 'Bad or expired Instagram token, log in to Instagram')
        );
    }
}
