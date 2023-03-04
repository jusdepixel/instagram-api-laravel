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
            'instagram_posts_count' => $this->media_count,
            'shared_posts_count' => $this->shared_count,
            'link' => '/api/users/' . $this->id,
            'posts' => new PostCollection($this->whenLoaded('instagram_posts')),
        ];
    }
}
