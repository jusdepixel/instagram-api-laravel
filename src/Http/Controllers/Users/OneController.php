<?php

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Users;

use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Http\Resources\User\UserResource;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Http\Response;

class OneController
{
    public function __invoke(string $id): UserResource|Response
    {
        if ($user = InstagramUser::query()->with('posts')->find($id)) {
            return new UserResource($user);
        }

        return response([
            'message' => 'This user does not exist or no longer exists'
        ], 404);
    }
}
