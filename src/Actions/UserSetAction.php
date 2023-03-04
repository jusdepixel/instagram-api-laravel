<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Exception;
use Jusdepixel\InstagramApiLaravel\Instagram\Auth;

final class UserSetAction
{
    /**
     * @throws Exception
     */
    public function process(): void
    {
        $auth = new Auth;
        $user = (new UserGetAction)->process();

        if ($user === null) {
            $user = (new UserCreateAction)->process();
        }

        $auth::setProfile([
            'access_token' => $user->__get('access_token'),
            'user_id' => $user->__get('id'),
            'expires_in' => $user->__get('expires_in'),
            'posts_auto' => $user->__get('posts_auto'),
        ]);
    }
}
