<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Post;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Author\AuthorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = 'post';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'caption' => $this->caption,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'thumbnail_url' => $this->thumbnail_url,
            'timestamp' => $this->timestamp,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'author' => new AuthorResource($this->whenLoaded('author')),
            'permalink' => $this->permalink,
            'link' => '/api/posts/' . $this->id,
        ];
    }
}
