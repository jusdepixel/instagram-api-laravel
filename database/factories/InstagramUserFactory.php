<?php

declare(strict_types=1);

namespace database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

/**
 * @extends Factory<InstagramUser>
 */
class InstagramUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => 'bac04411-0000-4cd2-b9d9-06ad4f9c1c62',
            'instagram_id' => 123456789,
            'username' => "userName",
            'media_count' => 42,
            'access_token' => 'sdsdkjçiqjlkqjdç_eseklkq,sdo,ce_lq,,scoijqelqek,dllqldkq,cv',
            'token_type' => 'Bearer',
            'expires_in' => 1677267776,
            'updated_time' => 1677267776,
            'created_at' => '2023-02-24T19:42:56.000000Z',
            'updated_at' => '2023-02-24T19:42:56.000000Z',
        ];
    }
}
