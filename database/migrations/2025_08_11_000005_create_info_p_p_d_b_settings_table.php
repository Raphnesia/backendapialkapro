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
        Schema::create('info_p_p_d_b_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Info PPDB');
            $table->text('subtitle')->default('Alur Pendaftaran SMP Muhammadiyah Al Kautsar PK Kartasura');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('cta_text')->default('Daftar Online');
            $table->string('cta_link')->default('https://ppdb.smpam.site');
            $table->text('contact_info')->nullable();
            $table->date('registration_deadline')->nullable();
            $table->string('academic_year')->default('2024/2025');
            $table->boolean('is_registration_open')->default(true);
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Introduction
            $table->string('intro_badge')->nullable();
            $table->string('intro_title')->nullable();
            $table->text('intro_subtitle')->nullable();

            // Featured image
            $table->string('featured_image')->nullable();
            $table->string('featured_overlay_title')->nullable();
            $table->text('featured_overlay_desc')->nullable();
            $table->string('featured_badge')->nullable();

            // Key points & alur/steps
            $table->json('key_points')->nullable();
            $table->string('alur_title')->nullable();
            $table->text('alur_subtitle')->nullable();
            $table->string('alur_image')->nullable();
            $table->json('steps')->nullable();

            // Program options section
            $table->string('program_section_badge')->nullable();
            $table->string('program_section_title')->nullable();
            $table->text('program_section_subtitle')->nullable();
            $table->json('program_rows')->nullable();

            // CTA extended
            $table->string('cta_background')->nullable();
            $table->string('cta_badge')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_primary_label')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_label')->nullable();
            $table->string('cta_secondary_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_p_p_d_b_settings');
    }
}; 