<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Illuminate\Database\Eloquent\Model;
use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

/**
 * @package Jusdepixel\InstagramApiLaravel\Actions\UserGetAction
 */
final class UserGetAction
{
    public function process(): Model|null
    {
        $auth = new Auth;

        return InstagramUser::query()
            ->where(['instagram_id' => $auth::getProfile()->instagramId])
            ->first();
    }
}
