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
            if (!Schema::hasColumn('prestasi_settings', 'badge_text')) {
                $table->string('badge_text')->default('SMP Muhammadiyah Al Kautsar')->after('hero_subtitle');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn('badge_text');
        });
    }
};
