<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Error;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Response;

final class PostDeleteController extends Controller
{
    public function __invoke(string $id): Response
    {
        return InstagramPost::query()->where([
            'id' => $id,
            'instagram_user_id' => self::$instagram::getProfile()->instagram_user_id])->delete()
        === 1  ?
            response([
                'message' =>  'Post has been deleted'
            ], 204)
        :
            response([
                'message' =>  'Post does not exist'
            ], 400);
    }
}
