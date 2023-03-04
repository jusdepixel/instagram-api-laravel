<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\User;

use Jusdepixel\InstagramApiLaravel\Http\Resources\Post\PostCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'media_count' => $this->media_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'link' => '/api/users/' . $this->id,
            'posts' => new PostCollection($this->whenLoaded('posts')),
        ];
    }
}
