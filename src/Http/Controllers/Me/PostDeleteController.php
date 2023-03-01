<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Response;

final class PostDeleteController
{
    public function __invoke(InstagramPost $post): Response
    {
        $post->delete();

        return response([
            'message' => 'Post has been deleted'
        ], 204);
    }
}
