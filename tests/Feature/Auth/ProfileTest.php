<?php

declare(strict_types=1);

namespace tests\Feature\Auth;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

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
                    ->where('userId', 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62')
                    ->where('accessToken', 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv')
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
