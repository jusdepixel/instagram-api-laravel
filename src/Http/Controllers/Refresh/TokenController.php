<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh;

use Exception;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

final class TokenController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(?string $token = null): Response
    {
        $profile = self::$instagram::setProfile([
            'token' => $token === null ? self::$instagram::requestRefreshToken() : $token
        ]);

        InstagramUser::query()
            ->where('id', self::$instagram::getProfile()->instagram_user_id)
            ->update([
                'access_token' => $profile->access_token,
                'expires_in' => $profile->expires_in,
            ]);

        return response([
            'message' => 'Your token has been updated',
            'profile' => $profile
        ]);
    }
}
