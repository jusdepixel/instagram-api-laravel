<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Error;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Response;

final class PostDeleteController
{
    public function __invoke(string $id): Response
    {
        try {
            InstagramPost::query()->find($id)->delete();
            return response(status: 204);
        } catch (Error) {
            return response([
                'message' =>  'Post does not exist'
            ], 400);
        }
    }
}
