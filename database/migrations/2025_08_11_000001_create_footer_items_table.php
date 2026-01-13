<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('footer_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('href', 500)->default('#');
            $table->string('target')->default('_self');
            $table->unsignedInteger('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('category')->default('menu-utama'); // menu-utama|informasi-akademik|sosial|lainnya
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_items');
    }
}; 