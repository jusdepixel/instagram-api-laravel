<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use GuzzleHttp\Client;

/**
 * Initialize configuration Instagram API and Guzzle client
 * @package Jusdepixel\InstagramApiLaravel\Instagram\Init
 */
class Init extends Session
{
    public const AUTHORIZE_URL = 'https://api.instagram.com/oauth/authorize';
    protected const TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
    protected const REFRESH_TOKEN_URL = "https://graph.instagram.com/refresh_access_token";
    protected const GRAPH_URL = "https://graph.instagram.com/";
    protected const MEDIAS_URI = "me/media";

    public static string $clientId;
    protected static string $clientSecret;
    public static string $redirectUri;

    protected static Client $clientGuzzle;
    public function __construct()
    {
        if (is_null(self::getSession())) {
            self::setSession(self::$session);
        }

        self::setClient();
        self::$clientId = config('instagram.client_id');
        self::$clientSecret = config('instagram.client_secret');
        self::$redirectUri = config('instagram.request_uri');
    }

    protected static function setClient(): void
    {
        self::$clientGuzzle = new Client();
    }

    public static function authorizeUrl(): string
    {
        return self::AUTHORIZE_URL .
            '?client_id='.self::$clientId .
            '&redirect_uri='.self::$redirectUri .
            '&scope=user_profile,user_media&response_type=code';
    }
}
