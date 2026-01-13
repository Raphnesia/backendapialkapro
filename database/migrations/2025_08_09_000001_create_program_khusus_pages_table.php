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
        Schema::create('program_khusus_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image_desktop')->nullable();
            $table->string('hero_image_mobile')->nullable();
            $table->string('overview_title')->nullable();
            $table->text('overview_subtitle')->nullable();
            $table->json('programs')->nullable();
            $table->string('reasons_title')->nullable();
            $table->text('reasons_subtitle')->nullable();
            $table->json('reasons')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_subtitle')->nullable();
            $table->string('cta_primary_label')->nullable();
            $table->string('cta_primary_url')->nullable();
            $table->string('cta_secondary_label')->nullable();
            $table->string('cta_secondary_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_khusus_pages');
    }
};


