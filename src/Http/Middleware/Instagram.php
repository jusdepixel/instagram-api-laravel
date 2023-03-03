<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Actions\UserSetAction;
use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Closure;
use Exception;

class Instagram
{
    public function handle($request, Closure $next): Response|JsonResponse
    {
        $auth = new Auth;

        if ($auth::getProfile()->isAuthenticated === false) {
            return (new InstagramException())->render(
                new Exception('MIDDLEWARE_INSTAGRAM', 403)
            );
        } else {
            try {
                (new UserSetAction)->process();
            } catch (Exception $e) {
                return (new InstagramException())->render($e);
            }
        }

        return $next($request);
    }
}
