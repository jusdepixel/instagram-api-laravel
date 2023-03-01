<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * InstagramUser model
 * @package Jusdepixel\InstagramApiLaravel\Models\InstagramUser
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
        'updated_time',
    ];

    protected int $instagram_id;
    protected string $username;
    protected int $media_count;
    protected string $access_token;
    protected string $token_type;
    protected string $expires_in;
    protected string $updated_time;

    public function posts(): HasMany
    {
        return $this->HasMany(InstagramPost::class);
    }
}
