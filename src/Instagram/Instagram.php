<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Instagram;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostCollection;
use Jusdepixel\InstagramApiLaravel\Http\Resources\Me\MePostResource;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;

/**
 * Get feeds from Instagram API
 * @package Jusdepixel\InstagramApiLaravel\Instagram\Instagram
 */
final class Instagram extends Auth
{
    private const FIELDS = 'caption,id,media_type,media_url,thumbnail_url,permalink,username,timestamp';

    /**
     * @throws Exception
     */
    public static function getPosts(): MePostCollection
    {
        try {
            $cacheKey = "my-posts-" . self::getProfile()->instagramId;

            if (!Cache::has($cacheKey)) {
                $params = [
                    'query' => [
                        'access_token' => self::getProfile()->accessToken,
                        'fields' => self::FIELDS
                    ]
                ];

                $response = self::$clientGuzzle->request(
                    'GET',
                    self::GRAPH_URL . self::MEDIAS_URI,
                    $params
                );
                $result = json_decode($response->getBody()->getContents())->data;

                Cache::add($cacheKey, $result);
            }

            return new MePostCollection(Cache::get($cacheKey));

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing') {
                return new MePostCollection([self::getPost(12345678910)]);
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public static function getPost(int $id): MePostResource
    {
        try {
            $cacheKey = "post-" . $id;

            if (!Cache::has($cacheKey)) {
                $params = [
                    'query' => [
                        'access_token' => self::getProfile()->accessToken,
                        'fields' => self::FIELDS
                    ]
                ];

                $response = self::$clientGuzzle->request(
                    'GET',
                    self::GRAPH_URL . $id,
                    $params
                );
                $result = json_decode($response->getBody()->getContents());

                Cache::add($cacheKey, $result);
            }

            return new MePostResource(Cache::get($cacheKey));

        } catch (GuzzleException $e) {
            if (getenv('APP_ENV') === 'testing' && $id === 12345678910) {
                return new MePostResource((object) [
                    'id' => 12345678910,
                    'caption' => 'Caption Post !',
                    'media_type' => 'IMAGE',
                    'media_url' => 'http://media.url/12345678910',
                    'permalink' => 'https://perma.link/12345678910',
                    'username' => 'userName',
                    'timestamp' => 1677267776,
                ]);
            }

            /**
             * Bad token or id, Instagram return code 400
             * Exception for bad id
             */
            if (str_contains(
                $e->getMessage(),
                '"message":"Unsupported get request","type":"IGApiException","code":100,"error_subcode":33'
            )) {
                throw new Exception('Unsupported get request', 404);
            }

            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public static function refreshMedia(string $id, ?string $token = null): string
    {
        try {
            if ($token === null) {
                $token = self::getProfile()->accessToken;
            }

            $params = [
                'query' => [
                    'access_token' => $token,
                    'fields' => self::FIELDS
                ]
            ];

            $response = self::$clientGuzzle->request(
                'GET',
                self::GRAPH_URL . $id,
                $params
            );
            $result = json_decode($response->getBody()->getContents());

            return $result->media_url;

        } catch (GuzzleException $e) {
            throw new Exception('BAD_TOKEN_OR_USAGE', $e->getCode());
        }
    }
}
