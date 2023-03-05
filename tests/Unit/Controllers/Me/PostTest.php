<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Controllers\Me;

use Exception;
use Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\PostController;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class PostTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_result()
    {
        self::fakeProfile();
        $response = (new PostController)->__invoke(12345678910);

        $expected = '{"message":"Bad or expired Instagram token, log in to Instagram"}';
        $this->assertEquals($expected, $response->content());
    }
}
