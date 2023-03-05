<?php

namespace Jusdepixel\InstagramApiLaravel\Tests\Unit\Jobs;

use Exception;
use Jusdepixel\InstagramApiLaravel\Database\Seeders\InstagramSeeder;
use Jusdepixel\InstagramApiLaravel\Jobs\RefreshMediaJob;
use Jusdepixel\InstagramApiLaravel\Tests\Instagram;

class RefreshMediaTest extends Instagram
{
    /**
     * @throws Exception
     */
    public function test_refresh_media_job_has_no_refresh()
    {
        $this->seed(InstagramSeeder::class);

        $result = (new RefreshMediaJob())->__invoke(20000);
        $this->assertEquals(0, $result);
    }

    /**
     * @throws Exception
     */
    public function test_refresh_media_job_has_refresh_exception()
    {
        $this->seed(InstagramSeeder::class);

        $this->expectException(Exception::class);
        (new RefreshMediaJob())->__invoke();
    }
}