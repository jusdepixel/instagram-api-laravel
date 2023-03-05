<?php

declare(strict_types=1);

namespace Jusdepixel\InstagramApiLaravel\Database\Seeders;

use Illuminate\Database\Seeder;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;

class InstagramSeeder extends Seeder
{
    public function run(): void
    {
        InstagramUser::factory()->create();
        InstagramPost::factory()->create();
    }
}
