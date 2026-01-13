<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hisbul_wathan_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('title_panel_bg_color')->default('bg-gradient-to-r from-green-600 to-green-800');
            $table->string('subtitle_panel_bg_color')->default('bg-gradient-to-r from-green-700 to-green-900');
            $table->string('mobile_panel_bg_color')->default('bg-gradient-to-r from-green-700 to-green-800');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hisbul_wathan_settings');
    }
}; 