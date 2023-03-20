<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Jusdepixel\InstagramApiLaravel\Models\InstagramUser;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('instagram_id')->unique();
            $table->string('timestamp');
            $table->string('caption')->nullable();
            $table->string('permalink');
            $table->string('media_type');
            $table->text('media_url');
            $table->string('thumbnail_url')->nullable();
            $table->timestamps();
            $table->string('instagram_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_posts');
    }
};
