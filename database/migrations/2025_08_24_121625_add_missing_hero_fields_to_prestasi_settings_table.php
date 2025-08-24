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
            if (!Schema::hasColumn('prestasi_settings', 'hero_background_color')) {
                $table->string('hero_background_color')->default('#1e40af')->after('main_heading');
            }
            if (!Schema::hasColumn('prestasi_settings', 'hero_text_color')) {
                $table->string('hero_text_color')->default('#ffffff')->after('hero_background_color');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_background_color', 'hero_text_color']);
        });
    }
};
