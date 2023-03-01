<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth;

use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class LogoutController extends Controller
{
    public function __invoke(): array
    {
        $userName = self::$instagram::getProfile()->userName;
        self::$instagram::logout();

        return [
            'message' => $userName . ' got disconnected from Instagram',
            'profile' => self::$instagram::getProfile(),
        ];
    }
}
