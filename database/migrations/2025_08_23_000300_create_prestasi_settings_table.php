<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_bg_from')->default('#d1fae5'); // from-green-100
            $table->string('hero_bg_via')->default('#eff6ff'); // via-blue-50
            $table->string('hero_bg_to')->default('#bbf7d0'); // to-green-200
            $table->string('badge_text')->default('SMP Muhammadiyah Al Kautsar');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_settings');
    }
}; 