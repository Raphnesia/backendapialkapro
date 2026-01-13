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
            if (!Schema::hasColumn('prestasi_settings', 'hero_subtitle')) {
                $table->text('hero_subtitle')->default('Siswa berprestasi dengan pencapaian luar biasa dan aktivasi instan bikin prestasi akademik dan non-akademik siap jalan bebas hambatan')->after('main_heading');
            }
            if (!Schema::hasColumn('prestasi_settings', 'feature_lists')) {
                $table->json('feature_lists')->default('["Prestasi Akademik Tinggi","Juara Olimpiade Nasional","Prestasi up to 150+ Penghargaan","Pengembangan Bakat Terpadu"]')->after('floating_elements_text_color');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_subtitle', 'feature_lists']);
        });
    }
};
