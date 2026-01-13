<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('section_type')->default('default');
            $table->json('config_data')->nullable();
            $table->timestamps();
            
            $table->index('is_active');
            $table->index('order_index');
            $table->index('section_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_sections');
    }
};