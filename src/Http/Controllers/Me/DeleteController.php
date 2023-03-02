<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

final class DeleteController extends Controller
{
    /**
     * @throws \Exception
     */
    public function __invoke(): Response
    {
        $user = InstagramUser::query()->find(self::$instagram::getProfile()->userId);

        if ($user instanceof InstagramUser) {
            $username = $user->__get('username');

            InstagramPost::query()
                ->where('instagram_user_id', self::$instagram::getProfile()->userId)
                ->delete();

            $user->delete();

            return response([
                'message' => $username . ' has been deleted'
            ], 204);

        }

        return response([
            'message' =>  'Post does not exist'
        ], 400);
    }
}
