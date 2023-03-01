<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Instagram;

class LogoutTest extends Instagram
{
    public function test_logout_status_success()
    {
        $response = $this->post('/api/auth/logout');

        $response->assertStatus(200);
    }

    public function test_logout_status_error_method()
    {
        $response = $this->get('/api/auth/logout');

        $response->assertStatus(405);
    }

    public function test_set_get_profile()
    {
        $this->assertEquals(
            self::$instagram::setProfile(self::$instagram::$session),
            self::$instagram::getProfile()
        );
    }

    public function test_logout_response_success()
    {
        self::fakeProfile();
        $response = $this->post('/api/auth/logout');

        $response->assertJson(fn (AssertableJson $json) =>
            $json
                ->where('message', 'userName got disconnected from Instagram')
                ->where('profile', (array) self::$instagram::setProfile(self::$instagram::$session))
        );
    }

    public function test_logout_response_error()
    {
        $fakeProfile = self::fakeProfile();
        $response = $this->post('/api/auth/logout');

        $expected = json_encode([
            'message' => "userName got disconnected from Instagram",
            'profile' => $fakeProfile
        ]);

        $this->assertNotEquals($expected, $response->content());
    }
}
