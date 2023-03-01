<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Init;

use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class AuthorizeUrlController extends Controller
{
    public function __invoke(): array
    {
        return [
            'authorizeUrl' => self::$instagram::authorizeUrl()
        ];
    }
}
