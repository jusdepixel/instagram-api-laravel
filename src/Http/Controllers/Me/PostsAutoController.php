<?php

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Exception;
use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MeUserResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

class PostsAutoController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(): Response
    {
        $user = InstagramUser::query()->find(self::$instagram::getProfile()->user_id);
        $user->update(['posts_auto' => !$user->__get('posts_auto')]);
        $user = $user->find(self::$instagram::getProfile()->user_id);
        self::$instagram::setProfile(['posts_auto' => $user->__get('posts_auto')]);

        return response([
            'message' => $user->__get('posts_auto') ? 'Automatic posts activated' : 'Automatic posts desactivated',
            'profile' => new MeUserResource($user)
        ]);
    }
}
