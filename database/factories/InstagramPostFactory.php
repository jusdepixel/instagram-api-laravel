<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

/**
 * @extends Factory<InstagramPost>
 */
class InstagramPostFactory extends Factory
{
    protected $model = InstagramPost::class;

    public function definition(): array
    {
        return [
            'id' => 'bac04411-9999-4cd2-b9d9-06ad4f9c1c62',
            'instagram_id' => 12345678910,
            'instagram_user_id' => '88888888-4444-4444-4444-121212121212',
            'caption' => 'Caption Post !',
            'media_type' => 'IMAGE',
            'media_url' => 'http://media.url/123456789',
            'permalink' => 'https://perma.link/123456789',
            'timestamp' => 1677267776,
            'thumbnail_url' => 'http://thumbnail.url/12345678910',
            'created_at' => '2023-02-24T19:42:56.000000Z',
            'updated_at' => '2023-02-24T19:42:56.000000Z',
        ];
    }
}
