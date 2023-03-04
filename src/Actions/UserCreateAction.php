<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Database\Eloquent\Model;

final class UserCreateAction
{
    /**
     * @throws Exception
     */
    public function process(): Model|null
    {
        return InstagramUser::query()->create(
            (new Auth)::requestLongLifeToken()->toArray()
        );
    }
}
