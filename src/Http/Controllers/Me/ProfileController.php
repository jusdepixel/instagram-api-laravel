<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Http\Resources\User\UserResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Illuminate\Http\Response;

final class ProfileController extends Controller
{
    public function __invoke(): Response
    {
        return response(
            new UserResource(InstagramUser::query()
                ->where(['instagram_id' => self::$instagram::getProfile()->instagramId])
                ->first()
            )
        );
    }
}
