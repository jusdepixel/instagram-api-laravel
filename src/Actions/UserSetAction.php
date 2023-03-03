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
            'accessToken' => $user->__get('access_token'),
            'userId' => getenv('APP_ENV') === 'testing' ?
                '88888888-4444-4444-4444-121212121212' :
                $user->__get('id'),
        ]);
    }
}
