<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_brandings', function (Blueprint $table) {
            $table->id();
            $table->string('header_logo')->nullable();
            $table->enum('footer_brand_type', ['text', 'image'])->default('text');
            $table->string('footer_brand_text')->nullable();
            $table->string('footer_brand_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_brandings');
    }
}; 