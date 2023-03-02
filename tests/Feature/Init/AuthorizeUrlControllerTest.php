<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Init;

use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class AuthorizeUrlControllerTest extends Instagram
{
    public function test_authorize_url_status()
    {
        $response = $this->get('/api/init/url');

        $response->assertStatus(200);

    }
    public function test_authorize_url_response()
    {
        $response = $this->get('/api/init/url');

        $expected = self::$instagram::AUTHORIZE_URL .
            '?client_id=' . self::$instagram::$clientId .
            '&redirect_uri=' . self::$instagram::$redirectUri .
            '&scope=user_profile,user_media&response_type=code';

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('authorizeUrl', $expected)
        );
    }
}
