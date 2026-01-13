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
        Schema::create('profil_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Profil SMP Muhammadiyah Al Kautsar PK Kartasura');
            $table->text('subtitle')->default('Informasi lengkap tentang sekolah kami');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->longText('description')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_settings');
    }
};
