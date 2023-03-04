<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Refresh;

use Exception;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

final class PostController extends Controller
{
    /**
     * @throws Exception
     */
    public function __invoke(string $instagram_id): Response
    {
        try {
            $post = InstagramPost::query()->where([
                'instagram_id' => $instagram_id,
                'instagram_user_id' => self::$instagram::getProfile()->instagram_user_id,
            ]);

            $post->update([
                'media_url' => self::$instagram::refreshMedia($instagram_id)
            ]);

            return response([
                'message' => 'Your post has been updated',
                'post' => new PostResource($post->with('author')->first())
            ]);
        } catch (Exception) {
            return response([
                'message' => 'This post is not yours',
            ], 400);
        }
    }
}
