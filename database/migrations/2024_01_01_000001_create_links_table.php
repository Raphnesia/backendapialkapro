<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->string('target')->default('_blank');
            $table->string('rel')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('category');
            $table->index('is_active');
            $table->index('order_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};