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
        Schema::create('alkapro_library_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic Page Settings
            $table->string('title')->default('Alkapro Library');
            $table->string('subtitle')->default('Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            
            // Hero Section Settings
            $table->string('hero_title')->default('Alkapro Library');
            $table->string('hero_subtitle')->default('Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura');
            $table->string('hero_image')->nullable();
            
            // Introduction Section
            $table->string('intro_badge_text')->default('Perpustakaan Sekolah');
            $table->string('intro_title')->default('Selamat Datang di Alkapro Library');
            $table->text('intro_description')->nullable();
            $table->string('intro_featured_image')->nullable();
            
            // Library Gallery Settings
            $table->json('library_gallery')->nullable(); // Array of image paths
            $table->boolean('gallery_auto_slide')->default(true);
            $table->integer('gallery_slide_interval')->default(4000); // milliseconds
            
            // Library Pamphlets Settings
            $table->json('library_pamphlets')->nullable(); // Array of pamphlet image paths
            $table->boolean('pamphlet_auto_slide')->default(true);
            $table->integer('pamphlet_slide_interval')->default(5000); // milliseconds
            
            // Service Hours Settings
            $table->string('service_hours_title')->default('Jam Layanan Perpustakaan Sekolah');
            $table->string('weekday_hours')->default('07.30 - 14.30 WIB');
            $table->string('weekend_hours')->default('07.30 - 11.00 WIB');
            $table->text('service_hours_note')->nullable();
            
            // Social Media Settings
            $table->string('instagram_username')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            
            // Call to Action Settings
            $table->string('cta_title')->default('Siap Menjelajahi Dunia Pengetahuan di Alkapro Library?');
            $table->text('cta_description')->nullable();
            $table->string('cta_background_image')->nullable();
            $table->string('cta_primary_button_text')->default('Tentang Sekolah');
            $table->string('cta_primary_button_url')->default('/profil');
            $table->string('cta_secondary_button_text')->default('Lihat Fasilitas Lain');
            $table->string('cta_secondary_button_url')->default('/fasilitas');
            
            // Features Section
            $table->string('features_title')->default('Koleksi Lengkap & Fasilitas Modern');
            $table->json('collection_features')->nullable(); // Array of collection features
            $table->json('facility_features')->nullable(); // Array of facility features
            
            // Programs Section
            $table->string('programs_title')->default('Program Unggulan Perpustakaan');
            $table->text('programs_description')->nullable();
            $table->string('reading_club_title')->default('Reading Club Alkapro');
            $table->text('reading_club_description')->nullable();
            $table->string('reading_club_image')->nullable();
            $table->string('digital_library_title')->default('Perpustakaan Digital');
            $table->text('digital_library_description')->nullable();
            $table->string('digital_library_image')->nullable();
            
            // Additional Services Section
            $table->string('services_title')->default('Layanan Tambahan');
            $table->text('services_description')->nullable();
            $table->json('additional_services')->nullable(); // Array of additional services
            
            // SEO Settings
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            
            // Display Settings
            $table->boolean('show_gallery')->default(true);
            $table->boolean('show_pamphlets')->default(true);
            $table->boolean('show_service_hours')->default(true);
            $table->boolean('show_social_media')->default(true);
            $table->boolean('show_programs')->default(true);
            $table->boolean('show_additional_services')->default(true);
            $table->boolean('show_cta_section')->default(true);
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alkapro_library_settings');
    }
};
