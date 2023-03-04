<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Me;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class MeUserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            "instagram_id" => $this->instagram_id,
            'media_count' => $this->media_count,
            'access_token' => $this->access_token,
            'expires_in' => $this->expires_in,
            'expires_in_human' => $this->expires_in_human,
            'posts_auto' => (bool) $this->posts_auto,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'link' => '/api/users/' . $this->id,
            'posts' => new PostCollection($this->whenLoaded('posts')),
        ];
    }
}
