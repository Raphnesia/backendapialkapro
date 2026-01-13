<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('position')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->string('type')->default('teacher'); // teacher or staff
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_active');
            $table->index('order_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};