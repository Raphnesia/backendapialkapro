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
            if (!Schema::hasColumn('prestasi_settings', 'main_heading')) {
                $table->string('main_heading')->default('Prestasi Sekolah')->after('id');
            }
            if (!Schema::hasColumn('prestasi_settings', 'floating_elements_bg_color')) {
                $table->string('floating_elements_bg_color')->default('#fbbf24')->after('badge_text');
            }
            if (!Schema::hasColumn('prestasi_settings', 'floating_elements_text_color')) {
                $table->string('floating_elements_text_color')->default('#ffffff')->after('floating_elements_bg_color');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            if (Schema::hasColumn('prestasi_settings', 'main_heading')) {
                $table->dropColumn('main_heading');
            }
            if (Schema::hasColumn('prestasi_settings', 'floating_elements_bg_color')) {
                $table->dropColumn('floating_elements_bg_color');
            }
            if (Schema::hasColumn('prestasi_settings', 'floating_elements_text_color')) {
                $table->dropColumn('floating_elements_text_color');
            }
        });
    }
};
