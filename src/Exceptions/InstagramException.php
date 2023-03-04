<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Exceptions;

use Illuminate\Database\QueryException;
use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Exception;
use Illuminate\Http\Response;

/**
 * @package Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException
 */
class InstagramException extends Exception
{
    private function myResponse(string $message, int $code, ?array $traces = null): Response
    {
        $response['message'] = $message;

        if (getenv('APP_ENV') !== 'testing') {
            $profile = Auth::getProfile();

            $profile->is_authenticated ?
                $response['profile'] = $profile :
                $response['authorizeUrl'] = Auth::authorizeUrl();

            if ($traces) {
                $response['traces'] = $traces;
            }
        }

        return response($response, $code);
    }

    public function render(Exception $e): Response
    {
        $code = $e->getCode();
        $message = $e->getMessage();

        switch ($message) {

            case 'BAD_TOKEN_OR_USAGE':
                Auth::logout();
                return $this->myResponse("Bad or expired Instagram token, log in to Instagram", $code);

            case 'BAD_CODE_OR_USAGE':
                return $this->myResponse("Bad or no longer valid code, or has already been used", $code);

            case 'MIDDLEWARE_INSTAGRAM':
                return $this->myResponse("Log in to Instagram to access this page", $code);
        }

        if ($code === 403) {
            return $this->myResponse("Instagram API usage cap reached, please wait", 403);
        }

        if ($e instanceof QueryException) {
            return $this->myResponse($message, 500);
        }

        return $code === 0 ?
            $this->myResponse($message, 500, $e->getTrace()) :
            $this->myResponse($message, $code);
    }
}
