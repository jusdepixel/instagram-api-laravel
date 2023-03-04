<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jusdepixel\InstagramApiLaravel\Database\Factories\InstagramUserFactory;

/**
 * @package Jusdepixel\InstagramApiLaravel\Models\InstagramUser
 * @factory Jusdepixel\InstagramApiLaravel\Database\Factories\InstagramUserFactory
 */
final class InstagramUser extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'instagram_id',
        'username',
        'access_token',
        'media_count',
        'token_type',
        'expires_in',
        'posts_auto',
    ];

    protected int $instagram_id;
    protected string $username;
    protected int $media_count;
    protected string $access_token;
    protected string $token_type;
    protected string $expires_in;
    protected bool $posts_auto;

    public function posts(): HasMany
    {
        return $this->HasMany(InstagramPost::class);
    }

    protected static function newFactory(): Factory
    {
        return InstagramUserFactory::new();
    }
}
