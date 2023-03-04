<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

/**
 * @package Jusdepixel\InstagramApiLaravel\Actions\UserDeleteAction
 */
final class UserDeleteAction
{
    public function process(): int
    {
        if ($user = (new UserGetAction)->process()) {
            (new Auth)::logout();

            return InstagramPost::query()
                ->where('instagram_user_id', $user->__get('id'))
                ->delete();
        }

        return 0;
    }
}
