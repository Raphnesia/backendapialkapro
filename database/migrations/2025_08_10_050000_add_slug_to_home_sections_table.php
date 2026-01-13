<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('home_sections', 'slug')) {
            Schema::table('home_sections', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
                $table->index('slug');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('home_sections', 'slug')) {
            Schema::table('home_sections', function (Blueprint $table) {
                $table->dropIndex(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};


