<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Post;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Author\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostResource
 */
class PostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'instagram_id' => $this->instagram_id,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'caption' => $this->caption,
            'permalink' => $this->permalink,
            'timestamp' => $this->timestamp,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'thumbnail_url' => $this->thumbnail_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
