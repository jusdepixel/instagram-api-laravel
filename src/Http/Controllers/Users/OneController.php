<?php

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Users;

use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\User\UserResource;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Http\Response;

class OneController
{
    public function __invoke(string $id): UserResource|Response
    {
        $user = InstagramUser::query()->with('posts')->find($id);

        if ($user) {
            return new UserResource($user);
        } else {
            return (new InstagramException())->render(
                new Exception("This user does not exist or no longer exists", 404)
            );
        }
    }
}
