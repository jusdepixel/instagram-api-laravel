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
    public function __invoke()
    {
        $nbDaysForRefresh = 2;
        $dateToRefresh = Carbon::now()->subDays($nbDaysForRefresh)->toDateTimeString();
        $mediasRefresh = [];
        $instagram = new Instagram();

        $mediasToRefresh = InstagramPost::query()
            ->select(
                'instagram_posts.id',
                'instagram_posts.instagram_id',
                'instagram_posts.instagram_user_id',
                'instagram_users.access_token'
            )
            ->where(
                'instagram_posts.updated_at',
                '<=',
                $dateToRefresh
            )
            ->join(
                'instagram_users',
                'instagram_posts.instagram_user_id',
                '=',
                'instagram_users.id'
            )
            ->get();

        foreach($mediasToRefresh as $media) {
            $newUrl = $instagram->refreshMedia($media->instagram_id, $media->access_token);

            $media::query()
                ->where('id', $media->id)
                ->update([
                    'media_url' => $newUrl
                ]);

            $mediasRefresh[$media->id] = $newUrl;
        }

        foreach($mediasRefresh as $id => $url) {
            print_r("\nRefresh $id ($url)");
        }
    }
}
