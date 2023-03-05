<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Refresh;

use Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh\TokenController;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class TokenTest extends Instagram
{
    /**
     * @throws \Exception
     */
    public function test_invoke_function()
    {
        self::fakeProfile();
        $result = (new TokenController)->__invoke('mon-token-de-test');
        $expected = [
            'message' => 'Your token has been updated',
            'profile' => self::$instagram::getProfile()
        ];

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertEquals(json_encode($expected), $result->content());
    }
}