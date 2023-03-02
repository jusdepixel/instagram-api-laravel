<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh;

use Exception;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;

final class TokenController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(): Response
    {
        $profile = self::$instagram::setProfile([
            'token' => self::$instagram::requestRefreshToken()
        ]);

        return response([
            'access_token' => $profile->accessToken
        ]);
    }
}
