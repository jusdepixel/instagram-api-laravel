<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject;
use Illuminate\Support\Facades\Session as IlluminateSession;

/**
 * Session Instagram user
 * @package Jusdepixel\InstagramApiLaravel\Instagram\Session
 */
class Session
{
    public static array $session = [
        'userName' => 'Anonymous',
        'mediaCount' => 0,
        'isAuthenticated' => false,
        'instagramId' => null,
        'userId' => null,
        'accessToken' => null,
    ];

    protected static function setSession(array $session): ProfileDataObject
    {
        IlluminateSession::put('instagram', json_encode($session));

        return self::getSession();
    }

    protected static function getSession(): ?ProfileDataObject
    {
        if (IlluminateSession::has('instagram')) {
            return ProfileDataObject::make(
                json_decode(IlluminateSession::get('instagram'))
            );
        }

        return null;
    }

    protected static function forgetSession(): ProfileDataObject
    {
        IlluminateSession::forget('instagram');

        return self::setSession(self::$session);
    }
}
