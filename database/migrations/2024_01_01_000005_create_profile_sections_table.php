<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('icon')->nullable();
            $table->string('subtitle')->nullable();
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('order_index');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_sections');
    }
};