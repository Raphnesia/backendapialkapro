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
        Schema::create('program_khusus_types', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            
            // Introduction Section
            $table->string('intro_badge')->nullable();
            $table->string('intro_title')->nullable();
            $table->text('intro_subtitle')->nullable();
            
            // Featured Image Section
            $table->string('featured_image')->nullable();
            $table->string('featured_overlay_title')->nullable();
            $table->text('featured_overlay_desc')->nullable();
            $table->string('featured_badge')->nullable();
            
            // Key Points Section
            $table->json('key_points')->nullable();
            
            // Features Grid Section
            $table->string('features_title')->nullable();
            $table->text('features_subtitle')->nullable();
            $table->string('features_image')->nullable();
            $table->json('features_items')->nullable();
            
            // Benefits Section
            $table->string('benefits_badge')->nullable();
            $table->string('benefits_title')->nullable();
            $table->text('benefits_subtitle')->nullable();
            $table->json('benefits_items')->nullable();
            
            // Gallery Section
            $table->string('gallery_title')->nullable();
            $table->text('gallery_subtitle')->nullable();
            $table->json('gallery_items')->nullable();
            
            // CTA Section
            $table->string('cta_background')->nullable();
            $table->string('cta_badge')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_primary_label')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_label')->nullable();
            $table->string('cta_secondary_url')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_khusus_types');
    }
};


