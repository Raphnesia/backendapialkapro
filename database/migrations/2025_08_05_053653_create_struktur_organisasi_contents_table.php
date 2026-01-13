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
        Schema::create('struktur_organisasi_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('grid_type')->default('grid-cols-1');
            $table->boolean('use_list_disc')->default(false);
            $table->json('list_items')->nullable();
            $table->json('bidang_structure')->nullable();
            $table->enum('display_type', ['list', 'bagan'])->default('list');
            $table->string('background_color')->default('bg-white');
            $table->string('border_color')->default('border-gray-200');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi_contents');
    }
};
