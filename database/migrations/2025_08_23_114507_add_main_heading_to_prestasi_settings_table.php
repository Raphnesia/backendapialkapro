<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->string('main_heading')->default('Prestasi Sekolah')->after('id');
        });
    }

    public function down()
    {
        Schema::table('prestasi_settings', function (Blueprint $table) {
            $table->dropColumn('main_heading');
        });
    }
};
