<?php

namespace Jusdepixel\InstagramApiLaravel\Jobs;

use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Jusdepixel\InstagramApiLaravel\Instagram\Instagram;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

class AutoRepostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @throws Exception
     */
    public function __invoke(): ?int
    {
        $instagram = new Instagram;
        $count = 0;

        if ($instagram::getProfile()->is_authenticated === true) {
            $count = $this->autoRepost($instagram);

        } else if ($users = $this->getTagetUsers()) {

            foreach ($users as $user) {
                $instagram::setProfile([
                    'instagram_user_id' => $user->id,
                    'access_token' => $user->access_token
                ]);
                $count += $this->autoRepost($instagram);
            }
        }

        if ($instagram::getProfile()->is_authenticated !== true) {
            print_r($count);
        }

        return $count;
    }

    /**
     * @throws Exception
     */
    private function autoRepost(Instagram $instagram): int
    {
        $timestamp = $this->getLastShared($instagram::getProfile()->instagram_user_id);
        $count = 0;

        if ($posts = $instagram::getPosts()) {
            foreach ($posts as $post) {
                if ($timestamp > $post->timestamp) {
                    try {
                        InstagramPost::query()->create(
                            $instagram::getPost($post->id)->toArray(new Request)
                        );
                        $count++;
                    } catch (QueryException) {}
                }
            }
        }

        return $count;
    }

    private function getTagetUsers(): Collection
    {
        return InstagramUser::query()
            ->select(['id', 'instagram_id', 'access_token'])
            ->where('posts_auto', '=', true)
            ->get();
    }

    private function getLastShared(string $userId): string
    {
        $lastShared = InstagramPost::query()
            ->select('created_at')
            ->where(['instagram_user_id' => $userId])
            ->orderByDesc('created_at')
            ->first();

        return $lastShared ? $lastShared->created_at : Carbon::now();
    }
}
