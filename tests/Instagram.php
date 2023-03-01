<?php

namespace Tests;

use Carbon\Carbon;
use Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Instagram as InstagramApi;

abstract class Instagram extends TestCase
{
    protected static InstagramApi $instagram;

    protected function setUp(): void
    {
        parent::setUp();

        self::$instagram = new InstagramApi();
    }

    /**
     * @throws \Exception
     */
    protected static function fakeProfile(): ProfileDataObject
    {
        return self::$instagram::setProfile([
            'userName' => 'userName',
            'isAuthenticated' => true,
            'instagramId' => 123456789,
            'mediaCount' => 42,
            'userId' => 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62',
            'accessToken' => 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv'
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

    protected static function expiresInHuman(int $expiresIn): string
    {
        $startDate = Carbon::createFromTimestamp(time());
        $endDate = Carbon::createFromTimestamp(time() + $expiresIn);

        $days = $startDate->diffInDays($endDate);
        $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
        $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);

        return "$days days, $hours hours and $minutes minutes";
    }
}
