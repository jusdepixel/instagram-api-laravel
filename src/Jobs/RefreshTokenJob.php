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
    public function __invoke(): void
    {
        $daysExpires = 2;
        $usersRefresh = [];
        $auth = new Auth();

        $usersToRefresh = InstagramUser::query()
            ->select('id', 'username', 'access_token')
            ->where('expires_in', '<', 86400 * $daysExpires)
            ->get();


        foreach ($usersToRefresh as $user) {
            $refreshToken = $auth::requestRefreshToken($user->access_token);

            $user::query()
                ->where('id', $user->id)
                ->update([
                    'access_token' => $refreshToken->access_token,
                    'token_type' => $refreshToken->token_type,
                    'expires_in' => $refreshToken->expires_in
                ]);

            $usersRefresh[$user->id] = $user->username;
        }

        foreach($usersRefresh as $id => $username) {
            print_r("\nRefresh $username ($id)");
        }
    }
}
