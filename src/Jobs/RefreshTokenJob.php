<?php

namespace Jusdepixel\InstagramApiLaravel\Jobs;

use Jusdepixel\InstagramApiLaravel\Instagram\Auth;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @throws Exception
     */
    public function __invoke(?int $daysExpires = null): int
    {
        $auth = new Auth;

        if ($daysExpires === null) {
            $daysExpires = 58;
        }

        $usersToRefresh = InstagramUser::query()
            ->select('id', 'username', 'access_token')
            ->where('expires_in', '<', 86400 * $daysExpires)
            ->get();

        $usersToRefresh->each(function ($user) use ($auth) {
            $refreshToken = $auth::requestRefreshToken($user->access_token);
            $user->update([
                'access_token' => $refreshToken->access_token,
                'token_type' => $refreshToken->token_type,
                'expires_in' => $refreshToken->expires_in
            ]);
        });

        return count($usersToRefresh);
    }
}
