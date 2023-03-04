<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

class Profile extends Init
{
    public static function getProfile(): ProfileDataObject
    {
        return self::getSession();
    }

    public static function setProfile(array $profile): ProfileDataObject
    {
        return self::setSession([
            ...self::getProfile()->toArray(),
            ...$profile
        ]);
    }

    /**
     * @throws Exception
     */
    public static function requestProfile(): array|ProfileDataObject
    {
        try {
            $cacheKey = "my-profile-" . self::getProfile()->instagram_id;

            if (!Cache::has($cacheKey)) {

                $params = [
                    'query' => [
                        'access_token' => self::getProfile()->access_token,
                        'fields' => 'account_type,media_count,username'
                    ]
                ];

                $response = self::$clientGuzzle->request(
                    'GET',
                    self::GRAPH_URL . "me",
                    $params
                );
                $result = json_decode($response->getBody()->getContents());

                Cache::add($cacheKey, $result);
            }

            $result = Cache::get($cacheKey);

            return self::setProfile([
                'username' => $result->username,
                'media_count' => $result->media_count,
            ]);

        } catch (GuzzleException) {
            throw new Exception('BAD_TOKEN_OR_USAGE', 400);
        }
    }
}
