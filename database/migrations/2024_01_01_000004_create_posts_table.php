<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->enum('type', ['news', 'article'])->default('news');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('author')->nullable();
            $table->json('tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_published');
            $table->index('category');
            $table->index('published_at');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};