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
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->string('main_heading')->default('Prestasi Sekolah')->after('id');
            $table->string('floating_elements_bg_color')->default('#fbbf24')->after('badge_text');
            $table->string('floating_elements_text_color')->default('#ffffff')->after('floating_elements_bg_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn(['main_heading', 'floating_elements_bg_color', 'floating_elements_text_color']);
        });
    }
};
