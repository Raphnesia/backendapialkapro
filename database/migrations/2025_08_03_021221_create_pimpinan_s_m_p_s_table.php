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
        Schema::create('pimpinan_s_m_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('education')->nullable();
            $table->text('experience')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->string('type'); // Jabatan yang bisa ditulis sendiri
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pimpinan_s_m_p_s');
    }
};
