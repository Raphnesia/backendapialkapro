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
        Schema::create('sub_facility_settings', function (Blueprint $table) {
            $table->id();
            $table->string('parent_slug'); // Link ke facility_boxes.link_slug
            $table->string('title');
            $table->text('subtitle');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('title_panel_bg_color')->default('bg-yellow-400');
            $table->string('subtitle_panel_bg_color')->default('bg-blue-600');
            $table->text('content_section_title')->nullable(); // Judul section content
            $table->longText('content_section_text')->nullable(); // Text content section
            $table->string('display_type')->default('grid'); // grid, list, gallery
            $table->boolean('show_photo_collage')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('parent_slug');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_facility_settings');
    }
}; 