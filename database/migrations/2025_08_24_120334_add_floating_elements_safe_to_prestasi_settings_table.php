<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('prestasi_settings', 'floating_elements_bg_color')) {
                $table->string('floating_elements_bg_color')->default('#fbbf24')->after('badge_text');
            }
            if (!Schema::hasColumn('prestasi_settings', 'floating_elements_text_color')) {
                $table->string('floating_elements_text_color')->default('#ffffff')->after('floating_elements_bg_color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn(['floating_elements_bg_color', 'floating_elements_text_color']);
        });
    }
};