<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh;

use Exception;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

final class PostController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(string $instagramId): Response
    {
        $url = self::$instagram::refreshMedia($instagramId);

        InstagramPost::query()
            ->update([
                'media_url' => $url
            ]);

        return response([
            'post' => InstagramPost::query()
                ->with('author')
                ->where('instagram_id', $instagramId)
                ->first()
        ]);
    }
}
