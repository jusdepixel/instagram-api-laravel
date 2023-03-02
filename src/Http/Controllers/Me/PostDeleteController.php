<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Http\Response;

final class PostDeleteController
{
    public function __invoke(string $id): Response
    {
        $result = InstagramPost::query()->find($id);

        if ($result) {
            $result->delete();

            return response([
                'message' => 'Post has been deleted'
            ], 204);

        }

        return response([
            'message' =>  'Post does not exist'
        ], 400);
    }
}
