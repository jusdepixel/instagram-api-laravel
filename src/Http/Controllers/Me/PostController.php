<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Jusdepixel\InstagramApiLaravel\Exceptions\InstagramException;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostResource;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;
use Illuminate\Http\Response;

final class PostController extends Controller
{
    /**
     * @param int $id
     * @return MePostResource|Response
     */
    public function __invoke(int $id): MePostResource|Response
    {
        try {
            return self::$instagram::getPost($id);
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
