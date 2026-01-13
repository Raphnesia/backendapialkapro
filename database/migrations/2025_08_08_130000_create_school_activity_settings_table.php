<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_activity_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('banner_desktop')->nullable();
            $table->string('banner_mobile')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_activity_settings');
    }
}; 