<?php

namespace Jusdepixel\InstagramApiLaravel\Tests;

use Carbon\Carbon;

use Exception;
use Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostResource;

abstract class Instagram extends TestCase
{
    /**
     * @throws Exception
     */
    protected static function fakeProfile(): ProfileDataObject
    {
        return self::$instagram::setProfile([
            'userName' => 'userName',
            'isAuthenticated' => true,
            'instagramId' => 123456789,
            'mediaCount' => 42,
            'userId' => '88888888-4444-4444-4444-121212121212',
            'accessToken' => 'iu0aMCsaepPy6ULphSX5PT32oPvKkM5dPl131knIDq9Cr8OUzzACsuBnpSJ_rE9XkGjmQVawcvyCHLiM4Kr6NA'
        ]);
    }

    protected static function fakePost(): MePostResource
    {
        $post = [
            'id' => 12345678910,
            'caption' => 'Caption Post !',
            'media_type' => 'IMAGE',
            'media_url' => 'http://media.url/12345678910',
            'permalink' => 'https://perma.link/12345678910',
            'username' => 'userName',
            'timestamp' => 1677267776,
        ];

        return new MePostResource((object) $post);
    }
}
