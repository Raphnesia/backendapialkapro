<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('info_p_p_d_b_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('info_p_p_d_b_settings', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('info_p_p_d_b_settings', function (Blueprint $table) {
            if (Schema::hasColumn('info_p_p_d_b_settings', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};