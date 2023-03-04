<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instagram_users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('instagram_id')->unique();
            $table->string('username')->nullable();
            $table->integer('media_count')->nullable();
            $table->string('access_token')->nullable();
            $table->integer('expires_in')->nullable();
            $table->boolean('posts_auto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instagram_users');
    }
};
