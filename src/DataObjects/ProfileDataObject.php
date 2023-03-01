<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\DataObjects;

/**
 * Profile structure for user session
 * @package Jusdepixel\InstagramApiLaravel\DataObjects\ProfileDataObject
 */
final class ProfileDataObject
{
    public function __construct(
        public string $userName,
        public bool $isAuthenticated,
        public ?int $instagramId,
        public ?string $userId,
        public int $mediaCount,
        public ?string $accessToken,
    ) {}

    public static function make(
        object $profile
    ): self {
        return new self(
            userName: $profile->userName,
            isAuthenticated: $profile->isAuthenticated,
            instagramId: $profile->instagramId,
            userId: $profile->userId,
            mediaCount: $profile->mediaCount,
            accessToken: $profile->accessToken,
        );
    }
}
