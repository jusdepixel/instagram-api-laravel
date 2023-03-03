<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class CodeController extends Controller
{
    public function __invoke(Request $request): array
    {
        return [
            'code' => self::$instagram::code($request->get('code'))
        ];
    }
}
