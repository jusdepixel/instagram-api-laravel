<?php

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Instagram;

use Exception;
use Illuminate\Support\Facades\Cache;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class ProfileTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_request_profile_exception()
    {
        $this->expectException(Exception::class);
        self::$instagram::requestProfile();
    }

    /**
     * @throws Exception
     */
    public function test_request_profile_with_cache_key()
    {
        Cache::put('my-profile-123456789', self::fakeProfile());
        $result = self::$instagram::requestProfile();

        $this->assertEquals(self::fakeProfile(), $result);
    }
}