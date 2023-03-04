<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Illuminate\Database\Eloquent\Model;
use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

final class UserGetAction
{
    public function process(): Model|null
    {
        return InstagramUser::query()
            ->where(['instagram_id' => (new Auth)::getProfile()->instagram_id])
            ->first();
    }
}
