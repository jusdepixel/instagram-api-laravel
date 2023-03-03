<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Database\Eloquent\Model;

final class UserCreateAction
{
    /**
     * @throws Exception
     */
    public function process(): Model|null
    {
        $auth = new Auth;

        $tokenInfos = $auth::requestLongLifeToken();

        return InstagramUser::query()->create([
            'instagram_id' => $auth::getProfile()->instagramId,
            'username' => $auth::getProfile()->userName,
            'media_count' => $auth::getProfile()->mediaCount,
            'access_token' => $tokenInfos['accessToken'],
            'token_type' => $tokenInfos['tokenType'],
            'expires_in' => $tokenInfos['expiresIn']
        ]);
    }
}
