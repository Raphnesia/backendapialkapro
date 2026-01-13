<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('info_p_p_d_b_settings', function (Blueprint $table) {
            // Introduction
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'intro_badge')) {
                $table->string('intro_badge')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'intro_title')) {
                $table->string('intro_title')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'intro_subtitle')) {
                $table->text('intro_subtitle')->nullable();
            }

            // Featured image
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'featured_image')) {
                $table->string('featured_image')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'featured_overlay_title')) {
                $table->string('featured_overlay_title')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'featured_overlay_desc')) {
                $table->text('featured_overlay_desc')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'featured_badge')) {
                $table->string('featured_badge')->nullable();
            }

            // Key points & alur
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'key_points')) {
                $table->json('key_points')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'alur_title')) {
                $table->string('alur_title')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'alur_subtitle')) {
                $table->text('alur_subtitle')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'alur_image')) {
                $table->string('alur_image')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'steps')) {
                $table->json('steps')->nullable();
            }

            // Program options
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'program_section_badge')) {
                $table->string('program_section_badge')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'program_section_title')) {
                $table->string('program_section_title')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'program_section_subtitle')) {
                $table->text('program_section_subtitle')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'program_rows')) {
                $table->json('program_rows')->nullable();
            }

            // CTA extended
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_background')) {
                $table->string('cta_background')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_badge')) {
                $table->string('cta_badge')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_title')) {
                $table->string('cta_title')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_description')) {
                $table->text('cta_description')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_primary_label')) {
                $table->string('cta_primary_label')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_primary_url')) {
                $table->string('cta_primary_url')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_secondary_label')) {
                $table->string('cta_secondary_label')->nullable();
            }
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'cta_secondary_url')) {
                $table->string('cta_secondary_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('info_p_p_d_b_settings', function (Blueprint $table) {
            $table->dropColumn([
                'intro_badge', 'intro_title', 'intro_subtitle',
                'featured_image', 'featured_overlay_title', 'featured_overlay_desc', 'featured_badge',
                'key_points', 'alur_title', 'alur_subtitle', 'alur_image', 'steps',
                'program_section_badge', 'program_section_title', 'program_section_subtitle', 'program_rows',
                'cta_background', 'cta_badge', 'cta_title', 'cta_description', 'cta_primary_label', 'cta_primary_url', 'cta_secondary_label', 'cta_secondary_url',
            ]);
        });
    }
};



