<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('prestasi_settings', function (Blueprint $table) {
            $table->id();
            $table->string('main_heading')->default('Prestasi Sekolah');
            $table->string('hero_background_color')->default('#1e40af');
            $table->string('hero_text_color')->default('#ffffff');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestasi_settings');
    }
}; 