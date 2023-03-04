<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject;
use Illuminate\Support\Facades\Session as IlluminateSession;

class Session
{
    public static array $session = [
        'username' => 'Anonymous',
        'media_count' => null,
        'is_authenticated' => false,
        'instagram_id' => null,
        'instagram_user_id' => null,
        'access_token' => null,
        'expires_in' => null,
        'posts_auto' => false,
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
