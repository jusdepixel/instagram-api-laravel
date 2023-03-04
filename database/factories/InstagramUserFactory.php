<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

/**
 * @extends Factory<InstagramUser>
 */
class InstagramUserFactory extends Factory
{
    protected $model = InstagramUser::class;

    public function definition(): array
    {
        return [
            'id' => '88888888-4444-4444-4444-121212121212',
            'instagram_id' => 123456789,
            'username' => "username",
            'media_count' => 42,
            'access_token' => 'iu0aMCsaepPy6ULphSX5PT32oPvKkM5dPl131knIDq9Cr8OUzzACsuBnpSJ_rE9XkGjmQVawcvyCHLiM4Kr6NA',
            'expires_in' => 1677267776,
            'created_at' => '2023-02-24T19:42:56.000000Z',
            'updated_at' => '2023-02-24T19:42:56.000000Z',
        ];
    }
}
