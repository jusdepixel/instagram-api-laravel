<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth;

use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class CodeController extends Controller
{
    public function __invoke($code): array
    {
        return [
            'code' => self::$instagram::code($code)
        ];
    }
}
