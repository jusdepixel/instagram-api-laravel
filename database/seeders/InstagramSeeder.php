<?php

declare(strict_types=1);

namespace database\seeders;

use Illuminate\Database\Seeder;
use Jusdepixel\InstagramApiLaravel\Models\InstagramPost;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

class InstagramSeeder extends Seeder
{
    public function run(): void
    {
        InstagramPost::factory()->create();
        InstagramUser::factory()->create();
    }
}
