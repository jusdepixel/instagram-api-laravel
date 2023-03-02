<?php

namespace Jusdepixel\InstagramApiLaravel\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Jusdepixel\InstagramApiLaravel\Instagram\Instagram as InstagramApi;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Jusdepixel\InstagramApiLaravel\InstagramServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    protected static InstagramApi $instagram;

    protected function setUp(): void
    {
        parent::setUp();

        self::$instagram = new InstagramApi();
    }

    protected function getPackageProviders($app): array
    {
        return [
            InstagramServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
