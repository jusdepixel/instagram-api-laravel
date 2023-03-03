<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Http\Resources\Author;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @package Jusdepixel\InstagramApiLaravel\Http\Resources\Author\AuthorResource
 */
final class AuthorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'link' => '/api/users/' . $this->id,
        ];
    }
}
