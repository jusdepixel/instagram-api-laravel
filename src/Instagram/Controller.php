<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Import Instagram library in controllers
 * @package Jusdepixel\InstagramApiLaravel\Instagram\Controller
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static Instagram $instagram;

    public function __construct()
    {
        self::$instagram = new Instagram();
    }
}
