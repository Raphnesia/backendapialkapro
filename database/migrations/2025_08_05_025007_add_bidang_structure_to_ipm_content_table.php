<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('ipm_content', 'bidang_structure')) {
            Schema::table('ipm_content', function (Blueprint $table) {
                $table->json('bidang_structure')->nullable()->after('list_items');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ipm_content', 'bidang_structure')) {
            Schema::table('ipm_content', function (Blueprint $table) {
                $table->dropColumn('bidang_structure');
            });
        }
    }
};
