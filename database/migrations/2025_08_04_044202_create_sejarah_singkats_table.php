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
        Schema::create('sejarah_singkats', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul section
            $table->text('content'); // Konten utama
            $table->string('grid_type')->default('grid-cols-1'); // grid-cols-1, grid-cols-2, dll
            $table->boolean('use_list_disc')->default(false); // Apakah menggunakan list-disc
            $table->json('list_items')->nullable(); // Array untuk list items jika use_list_disc = true
            $table->string('background_color')->default('bg-white'); // Warna background
            $table->string('border_color')->default('border-gray-100'); // Warna border
            $table->integer('order_index')->default(0); // Urutan tampilan
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah_singkats');
    }
};
