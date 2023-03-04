<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Auth;

use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class ProfileController extends Controller
{
    public function __invoke(): array
    {
        return self::$instagram::getProfile()->toArray();
    }
}
