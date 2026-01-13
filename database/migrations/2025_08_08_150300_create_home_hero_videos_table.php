<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('home_hero_videos')) {
            return;
        }
        Schema::create('home_hero_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('source_type')->default('upload'); // upload | url
            $table->string('video_file')->nullable();
            $table->string('mobile_video_file')->nullable();
            $table->string('video_url')->nullable();
            $table->string('mobile_video_url')->nullable();
            $table->string('poster_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
            $table->index(['is_active', 'order_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_hero_videos');
    }
}; 