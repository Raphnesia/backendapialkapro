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
        Schema::create('sejarah_singkat_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul halaman
            $table->text('subtitle'); // Subtitle halaman
            $table->string('banner_desktop')->nullable(); // Banner untuk desktop
            $table->string('banner_mobile')->nullable(); // Banner untuk mobile
            $table->string('title_panel_bg_color')->default('bg-green-500'); // Warna background title panel
            $table->string('subtitle_panel_bg_color')->default('bg-green-700'); // Warna background subtitle panel
            $table->string('mobile_panel_bg_color')->default('bg-green-600'); // Warna background mobile panel
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah_singkat_settings');
    }
};
