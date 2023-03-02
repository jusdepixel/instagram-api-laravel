<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Feature\Auth;

use Illuminate\Testing\Fluent\AssertableJson;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class ProfileTest extends Instagram
{
    public function test_profile_status_success()
    {
        $response = $this->get('/api/auth/profile');

        $response->assertStatus(200);
    }

    public function test_login_status_error_method()
    {
        $response = $this->post('/api/auth/profile');

        $response->assertStatus(405);
    }

    public function test_profile_response_success()
    {
        self::$instagram::setProfile(self::fakeProfile());
        $response = $this->get('/api/auth/profile');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('profile', fn ($json) =>
                $json
                    ->where('userName', 'userName')
                    ->where('isAuthenticated', true)
                    ->where('instagramId', 123456789)
                    ->where('mediaCount', 42)
                    ->where('userId', '88888888-4444-4444-4444-121212121212')
                    ->where('accessToken', 'iu0aMCsaepPy6ULphSX5PT32oPvKkM5dPl131knIDq9Cr8OUzzACsuBnpSJ_rE9XkGjmQVawcvyCHLiM4Kr6NA')
            )
        );
    }

    public function test_profile_response_error()
    {
        $expected = self::$instagram::setProfile(self::$instagram::$session);
        $response = $this->get('/api/auth/profile');

        $this->assertNotEquals($expected, json_decode($response->content()));
    }
}
