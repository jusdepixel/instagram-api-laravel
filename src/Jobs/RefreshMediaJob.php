<?php

namespace Jusdepixel\InstagramApiLaravel\Jobs;

use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Jusdepixel\InstagramApiLaravel\Instagram\Instagram;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

class RefreshMediaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @throws Exception
     */
    public function __invoke(?int $nbDays = null): int
    {
        $dateToRefresh = Carbon::now()->subDays($nbDays === null ? 2 : $nbDays)->toDateTimeString();
        $instagram = new Instagram;

        $mediasToRefresh = InstagramPost::query()
            ->select('id', 'instagram_id', 'instagram_user_id')
            ->with('instagram_user')
            ->where('updated_at', '<=', $dateToRefresh)
            ->get();

        $mediasToRefresh->each(function (InstagramPost $post) use ($instagram) {
            $post->update([
                'media_url' => $instagram->refreshMedia(
                    $post->__get('instagram_id'),
                    $post->__get('instagram_user')->__get('access_token')
                )
            ]);
        });

        return count($mediasToRefresh);
    }
}
