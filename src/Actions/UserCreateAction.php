<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Actions;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Create Instagram user on first share
 * @package Jusdepixel\InstagramApiLaravel\Actions\UserCreateAction
 */
final class UserCreateAction
{
    public function __construct(
        private Auth $auth
    ) {}

    /**
     * @throws Exception
     */
    public function setUser(): void
    {
        $user = $this->getUserInstagram();

        if (is_null($user)) {
            $user = $this->createUser();
        }

        $this->auth::setProfile([
            'accessToken' => $user->__get('access_token'),
            'userId' => getenv('APP_ENV') === 'testing' ? '88888888-4444-4444-4444-121212121212' : $user->id,
        ]);
    }

    /**
     * @throws Exception
     */
    private function getUserInstagram(): null|object
    {
        return InstagramUser::query()
            ->where(['instagram_id' => $this->auth::getProfile()->instagramId])
            ->first();
    }

    /**
     * @throws Exception
     */
    private function createUser(): Model
    {
        $tokenInfos = $this->auth::requestLongLifeToken();

        return InstagramUser::query()->create([
            'instagram_id' => $this->auth::getProfile()->instagramId,
            'username' => $this->auth::getProfile()->userName,
            'media_count' => $this->auth::getProfile()->mediaCount,
            'access_token' => $tokenInfos['accessToken'],
            'token_type' => $tokenInfos['tokenType'],
            'expires_in' => $tokenInfos['expiresIn']
        ]);
    }
}
