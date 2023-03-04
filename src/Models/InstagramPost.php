<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jusdepixel\InstagramApiLaravel\Database\Factories\InstagramPostFactory;

final class InstagramPost extends Model
{
    use HasFactory;
    use HasUuids;

    protected static function newFactory(): InstagramPostFactory
    {
        return InstagramPostFactory::new();
    }

    protected $fillable = [
        'instagram_id',
        'caption',
        'permalink',
        'media_type',
        'media_url',
        'thumbnail_url',
        'timestamp',
        'instagram_user_id'
    ];

    public function instagram_user(): BelongsTo
    {
        return $this->belongsTo(InstagramUser::class);
    }
}
