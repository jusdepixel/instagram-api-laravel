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
            'username' => 'username',
            'is_authenticated' => true,
            'instagram_id' => 123456789,
            'media_count' => 42,
            'user_id' => '88888888-4444-4444-4444-121212121212',
            'access_token' => 'iu0aMCsaepPy6ULphSX5PT32oPvKkM5dPl131knIDq9Cr8OUzzACsuBnpSJ_rE9XkGjmQVawcvyCHLiM4Kr6NA',
            'expires_in' => 86400,
            'expires_in_human' => '59 days, 10 hours and 52 minutes',
            'posts_auto' => false,

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
            'username' => 'username',
            'timestamp' => 1677267776,
        ];

        return new MePostResource((object) $post);
    }
}
