<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;

final class UserDeleteAction
{
    public function process(): bool
    {
        if ($user = (new UserGetAction)->process()) {
            (new Auth)::logout();

            return $user->delete();
        }

        return false;
    }
}
