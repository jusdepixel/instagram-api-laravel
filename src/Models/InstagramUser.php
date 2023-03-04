<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Jusdepixel\InstagramApiLaravel\Database\Factories\InstagramUserFactory;

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

    public function posts(): HasMany
    {
        return $this->HasMany(InstagramPost::class);
    }

    public function postsAuto(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => (bool) $value
        );
    }

    public function expiresInHuman(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getExpiresInHuman($this->expires_in)
        );
    }

    public function sharedCount(): Attribute
    {
        return Attribute::make(
            get: fn () => InstagramPost::query()->where('instagram_user_id', $this->id)->count()
        );
    }

    private function getExpiresInHuman(int $expiresIn): string
    {
        $startDate = Carbon::createFromTimestamp(time());
        $endDate = Carbon::createFromTimestamp(time() + $expiresIn);

        $days = $startDate->diffInDays($endDate);
        $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
        $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);

        return "$days days, $hours hours and $minutes minutes";
    }

    protected static function newFactory(): Factory
    {
        return InstagramUserFactory::new();
    }
}
