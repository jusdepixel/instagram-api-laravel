<?php

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Jobs;

use Exception;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Jobs\RefreshTokenJob;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class RefreshTokenTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_refresh_token_job_has_no_refresh()
    {
        $this->seed(InstagramSeeder::class);

        $result = (new RefreshTokenJob)->__invoke();
        $this->assertEquals(0, $result);
    }

    /**
     * @throws Exception
     */
    public function test_refresh_token_job_has_refresh()
    {
        $this->seed(InstagramSeeder::class);

        $this->expectException(Exception::class);
        (new RefreshTokenJob)->__invoke(62);
    }
}