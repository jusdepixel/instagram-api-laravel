<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\DataObjects;

final class ProfileDataObject
{
    public function __construct(
        public string $username,
        public bool $is_authenticated,
        public ?int $instagram_id,
        public ?string $instagram_user_id,
        public ?int $media_count,
        public ?string $access_token,
        public ?int $expires_in,
        public bool $posts_auto,
    ) {}

    public static function make(
        object $profile
    ): self {
        return new self(
            username: $profile->username,
            is_authenticated: $profile->is_authenticated,
            instagram_id: $profile->instagram_id,
            instagram_user_id: $profile->instagram_user_id,
            media_count: $profile->media_count,
            access_token: $profile->access_token,
            expires_in: $profile->expires_in,
            posts_auto: $profile->posts_auto,
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'is_authenticated' => $this->is_authenticated,
            'instagram_id' => $this->instagram_id,
            'instagram_user_id' => $this->instagram_user_id,
            'media_count' => $this->media_count,
            'access_token' => $this->access_token,
            'expires_in' => $this->expires_in,
            'posts_auto' => $this->posts_auto,
        ];
    }
}
