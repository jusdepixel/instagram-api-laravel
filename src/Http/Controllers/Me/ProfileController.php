<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MeUserResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Illuminate\Http\Response;

final class ProfileController extends Controller
{
    public function __invoke(): Response
    {
        return response(
            new MeUserResource(InstagramUser::query()
                ->find(self::$instagram::getProfile()->user_id)
                ->first()
            )
        );
    }
}
