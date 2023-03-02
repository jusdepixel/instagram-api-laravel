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

    private InstagramUser $user;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->user = new InstagramUser();
        $this->handle();
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $daysExpires = 60;
        $usersRefresh = [];
        $auth = new Auth();

        $usersToRefresh = $this->user::query()
            ->select('id', 'username', 'access_token')
            ->where('expires_in', '<', 86400 * $daysExpires)
            ->get();

        foreach ($usersToRefresh as $user) {
            [$accessToken, $tokenType, $expiresIn] = $auth::requestLongLifeToken($user->access_token);

            $this->user::query()
                ->where('id', $user->id)
                ->update([
                    'access_token' => $accessToken,
                    'token_typed' => $tokenType,
                    'expires_in' => $expiresIn
                ]);

            $usersRefresh[$user->id] = $user->username;
        }

        foreach($usersRefresh as $id => $username) {
            print_r("Refresh $username ($id)");
        }
    }
}
