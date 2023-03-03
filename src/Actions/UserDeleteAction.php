<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

/**
 * @package Jusdepixel\InstagramApiLaravel\Actions\UserDeleteAction
 */
final class UserDeleteAction
{
    public function process(): bool
    {
        $user = (new UserGetAction)->process();

        $posts = InstagramPost::query()
            ->where('instagram_user_id', $user->__get('id'))
            ->delete();

        return $posts ? $user->delete() : false;
    }
}
