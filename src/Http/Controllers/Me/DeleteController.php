<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Controllers\Me;

use Illuminate\Http\Response;
use Jusdepixel\InstagramApiLaravel\Actions\UserDeleteAction;
use Jusdepixel\InstagramApiLaravel\Instagram\Controller;

final class DeleteController extends Controller
{
    public function __invoke(): Response
    {
        if ((new UserDeleteAction)->process()) {
            return response([
                'message' => 'User and his posts has been deleted'
            ], 204);
        }

        return response([
            'message' =>  'User does not exist'
        ], 400);
    }
}
