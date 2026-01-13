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
        Schema::table('program_khusus_pages', function (Blueprint $table) {
            $table->string('section_title')->nullable()->after('overview_subtitle');
            $table->text('section_subtitle')->nullable()->after('section_title');
            $table->json('section_programs')->nullable()->after('section_subtitle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_khusus_pages', function (Blueprint $table) {
            $table->dropColumn(['section_title', 'section_subtitle', 'section_programs']);
        });
    }
};
