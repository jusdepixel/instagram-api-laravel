<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public $collects = PostResource::class;
    public static $wrap = 'posts';

    public function toArray($request): array
    {
        return [
            'posts' => $this->collection
                ->sortByDesc('created_at')
                ->values()
                ->all(),
            'count' => $this->count(),
            'links' => [
                'self' => url('/api/posts')
            ],
        ];
    }
}
