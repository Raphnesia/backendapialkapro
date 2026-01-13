<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->date('activity_date');
            $table->time('activity_time')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->json('participants')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
            $table->index('activity_date');
            $table->index('order_index');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_activities');
    }
};