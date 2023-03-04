<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\DataObjects;

final class ProfileDataObject
{
    public function __construct(
        public string $username,
        public bool $is_authenticated,
        public ?int $instagram_id,
        public ?string $user_id,
        public ?int $media_count,
        public ?string $access_token,
        public ?int $expires_in,
    ) {}

    public static function make(
        object $profile
    ): self {
        return new self(
            username: $profile->username,
            is_authenticated: $profile->is_authenticated,
            instagram_id: $profile->instagram_id,
            user_id: $profile->user_id,
            media_count: $profile->media_count,
            access_token: $profile->access_token,
            expires_in: $profile->expires_in,
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'is_authenticated' => $this->is_authenticated,
            'instagram_id' => $this->instagram_id,
            'user_id' => $this->user_id,
            'media_count' => $this->media_count,
            'access_token' => $this->access_token,
            'expires_in' => $this->expires_in,
        ];
    }
}
