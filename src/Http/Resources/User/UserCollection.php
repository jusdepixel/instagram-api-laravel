<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;
    public static $wrap = 'users';

    public function toArray($request): array
    {
        return [
            'data' => $this->collection
                ->sortByDesc('created_at')
                ->values()
                ->all(),
            'count' => $this->count(),
            'links' => [
                'self' => url('/api/users')
            ]
        ];
    }
}
