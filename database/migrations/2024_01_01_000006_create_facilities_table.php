<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('location')->nullable();
            $table->json('specifications')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
            $table->index('order_index');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};