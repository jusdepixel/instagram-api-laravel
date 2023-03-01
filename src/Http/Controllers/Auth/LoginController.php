<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth;

use Jusdepixel\InstagramApiLaravel\Actions\UserCacheAction;
use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;

final class LoginController extends Controller
{
    public function __invoke(string $code): array|Response
    {
        try {
            $profile = self::$instagram::login($code);

            new UserCacheAction();

            return [
                'messsage' => $profile->userName . ' is connected to Instagram',
                'profile' => $profile
            ];
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
