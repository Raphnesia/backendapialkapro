<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tapak_suci_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle');
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('title_panel_bg_color')->default('bg-gradient-to-r from-orange-600 to-red-700');
            $table->string('subtitle_panel_bg_color')->default('bg-gradient-to-r from-orange-700 to-red-800');
            $table->string('mobile_panel_bg_color')->default('bg-gradient-to-r from-orange-700 to-red-700');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tapak_suci_settings');
    }
}; 