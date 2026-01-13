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
        Schema::create('ekstrakurikuler_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('title_panel_bg_color')->default('bg-gradient-to-r from-blue-600 to-blue-800');
            $table->string('subtitle_panel_bg_color')->default('bg-gradient-to-r from-blue-700 to-blue-900');
            $table->string('mobile_panel_bg_color')->default('bg-gradient-to-r from-blue-700 to-blue-800');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler_settings');
    }
};
