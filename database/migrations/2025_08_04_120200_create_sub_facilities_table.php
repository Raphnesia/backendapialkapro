<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_facilities', function (Blueprint $table) {
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
            $table->string('parent_slug'); // Link ke facility_boxes.link_slug
            $table->timestamps();
            
            $table->index('parent_slug');
            $table->index('category');
            $table->index('is_active');
            $table->index('order_index');
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_facilities');
    }
}; 