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
        Schema::create('facility_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('background_image')->nullable();
            $table->string('link_slug')->nullable(); // Untuk membuat sub-fasilitas dinamis
            $table->string('bg_color')->default('bg-blue-600');
            $table->string('hover_bg_color')->default('bg-blue-700');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('creates_sub_facility')->default(false); // Apakah box ini akan membuat sub-fasilitas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_boxes');
    }
}; 