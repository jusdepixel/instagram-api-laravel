<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Exception;
use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Jusdepixel\InstagramApiLaravel\Instagram\Instagram;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class PostCreateController extends Controller
{
    public function __invoke(int $instagram_id, Request $request): Response
    {
        $instagramPost = null;

        try {
            $instagramPost = Instagram::getPost($instagram_id);

            $result = InstagramPost::query()->create(
                $instagramPost->toArray($request)
            );

            return response([
                'message' => 'Post has been added',
                'post' => new PostResource($result)
            ], 201);

        } catch (Exception $e) {

            if ($e instanceof QueryException &&
                $e->errorInfo[2] === 'UNIQUE constraint failed: instagram_posts.instagram_id'
            ) {
                return response([
                    'message' => 'Post already exists',
                    'post' => $instagramPost->toArray($request) // Défini car, existe déjà
                ], 201);
            }

            return (new InstagramException())->render($e);
        }
    }
}
