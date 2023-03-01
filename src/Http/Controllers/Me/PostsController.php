<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostCollection;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;

final class PostsController extends Controller
{
    public function __invoke(): MePostCollection|Response
    {
        try {
            return self::$instagram::getPosts();
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
