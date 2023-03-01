<?php

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Users;

use Jusdepixel\InstagramApiLaravel\Http\Resources\User\UserCollection;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

class AllController
{
    public function __invoke(): UserCollection
    {
        return new UserCollection(InstagramUser::all());
    }
}
