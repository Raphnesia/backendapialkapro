<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tapak_suci_content', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('grid_type')->default('grid-cols-1');
            $table->boolean('use_list_disc')->default(false);
            $table->json('list_items')->nullable();
            $table->json('bidang_structure')->nullable();
            $table->string('background_color')->default('bg-white');
            $table->string('border_color')->default('border-gray-200');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tapak_suci_content');
    }
}; 