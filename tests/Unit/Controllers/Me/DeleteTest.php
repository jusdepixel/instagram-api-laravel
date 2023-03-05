<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Controllers\Me;

use Exception;
use Jusdepixel\InstagramApiLaravel\Http\Controllers\Me\DeleteController;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class DeleteTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_result()
    {
        $response = (new DeleteController())->__invoke();

        $expected = '{"message":"User does not exist"}';
        $this->assertEquals($expected, $response->content());
    }
}
