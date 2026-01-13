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
        Schema::create('pimpinan_s_m_p_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon');
            $table->string('image')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('background_color')->default('green-600');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pimpinan_s_m_p_boxes');
    }
};
